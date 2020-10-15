<?php
return [
    'projectName' => 'phpOOP',
    'defaultController' => 'product',
    'components' => [
        'db' => [
            'class' => \app\services\DB::class,
            'config' => [
                'driver' => 'mysql',
                'host' => 'localhost',
                'dbName' => 'application_db',
                'charset' => 'UTF8',
                'login' => 'root',
                'password' => 'VvladmirRwh10'
            ]
        ],
        'render' => [
            'class' => \app\services\TwigRenderServices::class,
        ],
        'productRepository' => [
            'class' => \app\repositories\ProductRepository::class,
        ],
        'session' => [
            'class' => app\services\Session::class,
        ],
        'usersRepository' => [
            'class' => app\repositories\UsersRepository::class,
        ],
        'verificationRepository' => [
            'class' => \app\repositories\VerificationRepository::class,
        ]
    ]
];