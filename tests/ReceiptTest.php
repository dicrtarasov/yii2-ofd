<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 01.11.20 08:07:51
 */

declare(strict_types = 1);
namespace dicr\tests;

use dicr\helper\Url;
use dicr\ofd\receipt\OfdReceiptClient;
use PHPUnit\Framework\TestCase;
use Yii;
use yii\base\Exception;
use yii\base\InvalidConfigException;

/**
 * Class ReceiptTest
 */
class ReceiptTest extends TestCase
{
    /** @var string[] коды QR */
    public const CHECKS = [
        20200820 => 't=20200820T1551&s=811.89&fn=9282440300655029&i=8656&fp=3756455579&n=1',
        20200823 => 't=20200823T1052&s=1174.94&fn=9285440300243377&i=14986&fp=3750713537&n=1',
        20200825 => 't=20200825T1500&s=899.00&fn=9280440300704411&i=45389&fp=236215535&n=1'
    ];

    /**
     * @return OfdReceiptClient
     * @throws InvalidConfigException
     */
    private static function client() : OfdReceiptClient
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return Yii::$app->get('ofdReceiptClient');
    }

    /**
     * @throws Exception
     */
    public function testSend() : void
    {
        $client = self::client();

        $req = $client->qrRequest(Url::parseQuery(self::CHECKS[20200825]));

        $res = $req->send();

        /** @noinspection ForgottenDebugOutputInspection */
        var_dump($res->attributes);
        exit;
    }
}
