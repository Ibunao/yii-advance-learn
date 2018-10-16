<?php
namespace restful\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use restful\models\ProductModel;
# 可以同时实现下面三种验证方法
use yii\filters\auth\CompositeAuth;
# 浏览器弹窗口输入获取token
use yii\filters\auth\HttpBasicAuth;
# 从head头获取验证的token
use yii\filters\auth\HttpBearerAuth;
# 从请求链接中获取验证的token
use yii\filters\auth\QueryParamAuth;

class ProductController extends ActiveController
{
	public $modelClass = 'restful\models\ProductModel';
	/**
	 * 覆盖behaviors方法
	 * @return [type] [description]
	 */
	public function behaviors()
	{
	    $behaviors = parent::behaviors();
	    // 重写验证过滤器的配置
	    $behaviors['authenticator'] = [
	        'class' => HttpBearerAuth::className(),
	        // 可以不验证的action
			// 'optional' => ['index']
	    ];
	    return $behaviors;
	}
	/**
	 * 添加额外配置的action
	 * @return [type] [description]
	 */
	public function actionSearch()
	{
		return Yii::$app->request->post();
	}
	/**
	 * 检查权限
	 * @param  [type] $action actionId
	 * @param  [type] $model  模型对象
	 * @param  array  $params 
	 * @return [type]         [description]
	 */
	public function checkAccess($action, $model = null, $params = [])
	{
	    if ($action === 'update' || $action === 'delete') {
	        if ($model->order !== Yii::$app->user->id)
	        	// 不满足抛出异常
	            throw new \yii\web\ForbiddenHttpException(sprintf('You can only %s articles that you\'ve created.', $action));
	    }
	}
}