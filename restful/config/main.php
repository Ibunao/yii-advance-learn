<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-restful',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'restful\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-restful',
            // 配置获取请求参数的格式
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            // 不允许使用session
            'enableSession' => false,
        ],
        'session' => [
            // this is the name of the session cookie used for login on the restful
            'name' => 'advanced-restful',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            // 最好开启，如果不走rest的路由规则不满足就不用使用默认的了
            // 'enableStrictParsing' => true,
            'showScriptName' => false,
            // 配置url解析规则类
            'rules' => [
                /**
                 * controller 配置的控制器id 配置的控制器访问的时候要用复数的形式
                 * 如：GET users
                 */
                ['class' => 'yii\rest\UrlRule', 'controller' => ['user']],
                /**
                 * 配置控制器ID 的映射。 
                 * 访问格式如：GET u
                 */
                // ['class' => 'yii\rest\UrlRule', 'controller' => ['u' => 'user']],
                /**
                 * 其他常用的配置。
                 * 
                 */
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'product',
                    // 用来禁止复数形式
                    // 'pluralize' => false,
                    // 只有delete允许请求，如果请求，将会返回404
                    // 'only' => ['delete'],
                    // 排除对index的请求，其他的都可以，如果请求，将会返回请求options的结果
                    // 'except' => ['index'],
                    // 排除对delete的请求，其他的都可以，如果请求，将会返回请求options的结果
                    'except' => ['delete'],
                    // 配置额外自定义的访问
                    // 访问格式如 GET /products/search 可以支持新行为 search
                    'extraPatterns' => [
                        'POST search' => 'search',
                    ],
                ],
            ],
        ],

    ],
    'params' => $params,
];
