<?php
return [
    'language' => 'ru-RU',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\EmailTarget',
                    'mailer' => 'mailer',
                    'except' => ['yii\web\HttpException:404'],
                    'levels' => ['error', 'warning'],
                    'message' => [
                        'from' => ['admin@example.com'],
                        'to' => ['admin@example.com'],
                        'subject' => 'Ошибки на TestSite',
                    ],
                ],
            ],
        ],
    ],
];
