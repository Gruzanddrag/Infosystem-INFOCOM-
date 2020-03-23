<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],
        'request' => [
            'cookieValidationKey' => 'ejppLS_1EQ1SWuoYbc6SNDn18YE9KaeF',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                // Yii::error($response->data);
                // if we have options request - return 200 with headers
                if(Yii::$app->request->isOptions){
                    $response->statusCode=200;
                    $response->data = NULL;
                } else if ($response->data !== null) {
                    $response->data = [
                        'status' => $response->isSuccessful,
                        'data' => $response->data,
                    ];
                }
            },
        ],
        'jwt' => [
            'class' => \sizeg\jwt\Jwt::class,
            'key' => 'secret',
            // You have to configure ValidationData informing all claims you want to validate the token.
            'jwtValidationData' => \app\components\JWT\JwtValidationData::class,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableSession' => false,
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,          
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => ['v1/umk'], 'pluralize'=>false],
                ['class' => 'yii\rest\UrlRule', 'controller' => ['v1/disciplines']],
                ['class' => 'yii\rest\UrlRule', 'controller' => ['v1/student-requirement-type']],
                ['class' => 'yii\rest\UrlRule', 'controller' => ['v1/discipline-types']],
                ['class' => 'yii\rest\UrlRule', 'controller' => ['v1/requests']],
                ['class' => 'yii\rest\UrlRule', 'controller' => ['v1/resources']],
                ['class' => 'yii\rest\UrlRule', 'controller' => ['v1/resource-types']],
                ['class' => 'yii\rest\UrlRule', 'controller' => ['v1/resource-movements']],
            ],
        ],
    ],
    'params' => $params,
    'modules' => [
        'v1' => [
            'class' => 'app\modules\umk\Module',
        ],
    ],
    'on beforeRequest' => function(){
        $response = Yii::$app->response;
        $response->headers->fromArray(array(
            "Access-Control-Allow-Origin" => ['*'],
            "Access-Control-Allow-Headers" => ['*'],
            "Access-Control-Allow-Methods"=> ["*"],
            "Access-Control-Max-Age" => ["86400"]
        ));
    }
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
