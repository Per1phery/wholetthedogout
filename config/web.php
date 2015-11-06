<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'aliases' => [
        '@uploads' => '@app/web/uploads',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\AdminModule',
        ],
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'admin' => 'feedback/index',
                'admin/feedback' => 'feedback/index',
                'admin/carousel' => 'carousel/index',
                'admin/carousel/create' => 'carousel/create',
                'admin/settings' => 'settings/index',
                'admin/file' => 'file/index',
                'admin/user-managment' => 'user-managment/index',
                'admin/user-managment/create' => 'user-managment/create',
                'admin/user-managment/profile' => 'user-managment/profile',
                'admin/user-managment/change-password' => 'user-managment/change-password',
            ]
        ],
        'i18n' => [
            'translations' => [
                'app*'=> [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                ]
            ]
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'AQQJ6p_Cs3b_QnyfLuIW-f04BBY19sSh',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\UserModel',
//            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            //'loginUrl' => ['site/sign-in'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['192.168.*.*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['192.168.*.*'],
    ];
}

return $config;