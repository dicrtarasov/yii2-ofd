<?php

/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 22.10.20 23:15:33
 */
declare(strict_types = 1);

/** среда разработки */
defined('YII_ENV') || define('YII_ENV', 'dev');

/** режим отладки */
defined('YII_DEBUG') || define('YII_DEBUG', true);

require_once(dirname(__DIR__) . '/vendor/autoload.php');
require_once(dirname(__DIR__) . '/vendor/yiisoft/yii2/Yii.php');

/** @noinspection PhpUnhandledExceptionInspection */
new yii\console\Application([
    'id' => 'test',
    'basePath' => dirname(__DIR__),
    'components' => [
        'urlManager' => [
            'hostInfo' => 'https://localhost'
        ],
        'cache' => [
            'class' => yii\caching\FileCache::class
        ],
        'log' => [
            'class' => yii\log\Dispatcher::class,
            'flushInterval' => 1,
            'targets' => [
                [
                    'class' => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning', 'info', 'trace']
                ]
            ]
        ],
        'ofdReceiptClient' => [
            'class' => dicr\ofd\receipt\OfdReceiptClient::class,
            'apiKey' => '470a4f4166ed3d4eeab9cf4fdcbedd46'
        ],
        'ofdTicketClient' => [
            'class' => dicr\ofd\ticket\OfdTicketClient::class
        ]
    ],
    'bootstrap' => ['log']
]);
