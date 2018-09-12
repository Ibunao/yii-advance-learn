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
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-restful', 'httpOnly' => true],
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
            'showScriptName' => false,
            'rules' => [
                /**
                 * 配置url解析规则类
                 * controller 配置的控制器id 配置的控制器访问的时候要用复数的形式  
                 * 
                 */
                ['class' => 'yii\rest\UrlRule', 'controller' => ['user']],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'product',
                    // 只有delete允许请求，如果请求，将会返回404
                    // 'only' => ['delete'],
                    // 排除对index的请求，其他的都可以，如果请求，将会返回请求options的结果
                    // 'except' => ['index'],
                    // 排除对delete的请求，其他的都可以，如果请求，将会返回请求options的结果
                    'except' => ['delete'],
                ],
            ],
        ],
        
    ],
    'params' => $params,
];
