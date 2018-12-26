<?php
namespace common\behaviors;

use Yii;
use yii\base\ActionFilter;
use yii\web\Request;
use yii\web\Response;
use yii\web\TooManyRequestsHttpException;

/**
 * RateLimiter implements a rate limiting algorithm based on the [leaky bucket algorithm](http://en.wikipedia.org/wiki/Leaky_bucket).
 *
 * You may use RateLimiter by attaching it as a behavior to a controller or module, like the following,
 *
 * ```php
 * public function behaviors()
 * {
 *     return [
 *         'ipRateLimiter' => [
 *             'class' => \common\behaviors\IpRateLimiter::className(),
 *             'enabled' => true
 *         ],
 *     ];
 * }
 * ```
 *
 * When the user has exceeded his rate limit, RateLimiter will throw a [[TooManyRequestsHttpException]] exception.
 *
 *
 * @since 2.0
 */
class IpRateLimiter extends ActionFilter
{
    /**
     * @var bool whether to include rate limit headers in the response
     */
    public $enableRateLimitHeaders = true;
    /**
     * @var string the message to be displayed when rate limit exceeds
     */
    public $errorMessage = 'Rate limit exceeded.';
    /**
     * 访问的ip
     */
    public $ip;
    # 缓存的key
    private $cacheKey;
    /**
     * 是否启用
     * @var [type]
     */
    public $enabled = false;
    /**
     * @var Request the current request. If not set, the `request` application component will be used.
     */
    public $request;
    /**
     * @var Response the response to be sent. If not set, the `response` application component will be used.
     */
    public $response;


    /**
     * {@inheritdoc}
     */
    public function init()
    {
        if ($this->request === null) {
            $this->request = Yii::$app->getRequest();
        }
        if ($this->response === null) {
            $this->response = Yii::$app->getResponse();
        }
        if ($this->ip === null) {
            $this->ip = $this->request->getUserIP();
        }
        $this->cacheKey = 'ip-rate-limiter-key'.$this->ip;
    }

    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        # 如果配置了速率，进行检查
        if ($this->enabled) {
            Yii::debug('Check ip rate limit', __METHOD__);
            $this->checkRateLimit($this->request, $this->response, $action);
        }
            
        return true;
    }

    /**
     * 检查速率
     * Checks whether the rate limit exceeds.
     * @param RateLimitInterface $user the current user
     * @param Request $request
     * @param Response $response
     * @param \yii\base\Action $action the action to be executed
     * @throws TooManyRequestsHttpException if rate limit exceeds
     */
    public function checkRateLimit($request, $response, $action)
    {
        // 获取速率限制 最大次数 时间段
        list($limit, $window) = $this->getRateLimit($request, $action);
        // 剩余允许请求数量 上次访问的时间戳
        list($allowance, $timestamp) = $this->loadAllowance($request, $action);

        $current = time();
        // 计算允许的请求数量
        $allowance += (int) (($current - $timestamp) * $limit / $window);
        if ($allowance > $limit) {
            $allowance = $limit;
        }
        // 请求量用完了, 直接抛出异常
        if ($allowance < 1) {
            $this->saveAllowance($request, $action, 0, $current);
            $this->addRateLimitHeaders($response, $limit, 0, $window);
            throw new TooManyRequestsHttpException($this->errorMessage);
        }

        $this->saveAllowance($request, $action, $allowance - 1, $current);
        $this->addRateLimitHeaders($response, $limit, $allowance - 1, (int) (($limit - $allowance + 1) * $window / $limit));
    }

    /**
     * Adds the rate limit headers to the response.
     * @param Response $response
     * @param int $limit the maximum number of allowed requests during a period
     * @param int $remaining the remaining number of allowed requests within the current period
     * @param int $reset the number of seconds to wait before having maximum number of allowed requests again
     */
    public function addRateLimitHeaders($response, $limit, $remaining, $reset)
    {
        if ($this->enableRateLimitHeaders) {
            $response->getHeaders()
                ->set('X-Rate-Limit-Limit', $limit)// 同一个时间段所允许的请求的最大数目;
                ->set('X-Rate-Limit-Remaining', $remaining)// 在当前时间段内剩余的请求的数量;
                ->set('X-Rate-Limit-Reset', $reset);// 为了得到最大请求数所等待的秒数。
        }
    }
    /**
     * 返回一段时间内允许请求的最大次数
     * @param  [type] $request request 对象
     * @param  [type] $action  访问的action
     * @return [type]          [description]
     */
    public function getRateLimit($request, $action)
    {
        // 每五秒可以访问2次
        return [2, 5];
    }
    /**
     * 获取允许请求的数量和最后的访问的时间戳
     * @param  [type] $request request 对象
     * @param  [type] $action  访问的action
     * @return [type]  [请求次数, 最后访问时间]  
     */
    public function loadAllowance($request, $action)
    {
        if ($data = Yii::$app->cache->get($this->cacheKey)) {
            return $data;
        }
        return [0, 0];
    }
    /**
     * 保存剩余的请求数量和最后的访问时间
     * @param  [type] $request   request 对象
     * @param  [type] $action    请求的action
     * @param  [type] $allowance 允许的次数
     * @param  [type] $timestamp 当前时间
     * @return [type]            [description]
     */
    public function saveAllowance($request, $action, $allowance, $timestamp)
    {
        Yii::$app->cache->set($this->cacheKey, [$allowance, $timestamp]);
    }
}
