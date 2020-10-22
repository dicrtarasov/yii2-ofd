<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 22.10.20 23:15:57
 */

declare(strict_types = 1);
namespace dicr\tests;

use dicr\ofd\ticket\FindTicketResponse;
use dicr\ofd\ticket\OfdTicketClient;
use PHPUnit\Framework\TestCase;
use Yii;
use yii\base\Exception;
use yii\base\InvalidConfigException;

/**
 * Class TicketTest
 */
class TicketTest extends TestCase
{
    /**
     * Клиент.
     *
     * @return OfdTicketClient
     * @throws InvalidConfigException
     */
    private static function client() : OfdTicketClient
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return Yii::$app->get('ofdTicketClient');
    }

    /**
     * @throws Exception
     */
    public function testTicket() : void
    {
        // поиск UID чека
        $req = self::client()->findTicketRequest([
            'fiscalDocumentNumber' => '58518', // i
            'fiscalId' => '957304760', // fp
            'fiscalDriveId' => '8710000100620128' // fn
        ]);

        $res = $req->send();
        self::assertSame($res->status, FindTicketResponse::STATUS_FOUND);
        self::assertNotEmpty($res->uid);
        echo 'UID: ' . $res->uid . "\n";

        // получение информации о чеке
        $req = self::client()->getTicketRequest([
            'uid' => $res->uid
        ]);

        $res = $req->send();
        self::assertIsArray($res);
        self::assertArrayHasKey('ticket', $res);
        self::assertIsArray($res['ticket']);
        self::assertArrayHasKey('items', $res['ticket']);
        self::assertIsArray($res['ticket']['items']);
        self::assertNotEmpty($res['ticket']['items']);

        self::assertArrayHasKey('totalSum', $res['ticket']);
        self::assertArrayHasKey('totalSum', $res['ticket']);
        self::assertSame(798, $res['ticket']['totalSum']);

        echo 'Sum: ' . $res['ticket']['totalSum'] . "\n";
    }
}
