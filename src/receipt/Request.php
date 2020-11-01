<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 01.11.20 08:07:51
 */

declare(strict_types = 1);
namespace dicr\ofd\receipt;

use dicr\json\JsonEntity;
use dicr\validate\ValidateException;
use Yii;
use yii\base\Exception;
use yii\httpclient\Client;

use function array_keys;

/**
 * Запрос чека по данным, содержащимся в QR-коде.
 */
class Request extends JsonEntity
{
    /** @var ?string необязательный идентификатор пользователя (Android-App) */
    public $REQUESTOR;

    /** @var string локальные дата и время (20180514T1306) */
    public $t;

    /** @var float сумма расчета (1116.83) */
    public $s;

    /** @var string заводской номер фискального накопителя (37280722) */
    public $fn;

    /** @var int порядковый номер фискального документа (137280722) */
    public $i;

    /** @var int фискальный признак документа (1996187607) */
    public $fp;

    /**
     * @var int признак расчета (1)
     * @see OperationType
     */
    public $n;

    /** @var OfdReceiptClient */
    private $client;

    /**
     * QrRequest constructor.
     *
     * @param OfdReceiptClient $client
     * @param array $config
     */
    public function __construct(OfdReceiptClient $client, $config = [])
    {
        $this->client = $client;

        parent::__construct($config);
    }

    /**
     * @inheritDoc
     */
    public function rules() : array
    {
        return [
            ['REQUESTOR', 'trim'],
            ['REQUESTOR', 'default'],

            ['t', 'required'],
            ['t', 'date', 'format' => 'php:Ymd\THi'],

            ['s', 'required'],
            ['s', 'number', 'min' => 0.01],
            ['s', 'filter', 'filter' => 'floatval'],

            ['fn', 'trim'],
            ['fn', 'required'],
            ['fn', 'integer', 'min' => 1],

            ['i', 'required'],
            ['i', 'integer', 'min' => 1],
            ['i', 'filter', 'filter' => 'intval'],

            ['fp', 'required'],
            ['fp', 'integer', 'min' => 1],
            ['fp', 'filter', 'filter' => 'intval'],

            ['n', 'required'],
            ['n', 'in', 'range' => array_keys(OperationType::VALUES)],
        ];
    }

    /**
     * @inheritDoc
     */
    public static function attributeFields() : array
    {
        return [];
    }

    /**
     * Отправляет данные.
     *
     * @return Response
     * @throws Exception
     */
    public function send() : Response
    {
        if (! $this->validate()) {
            throw new ValidateException($this);
        }

        $req = $this->client->httpClient->get('getTicketByQR', $this->json, [
            'apikey' => $this->client->apiKey
        ]);

        Yii::debug('Запрос: ' . $req->toString(), __METHOD__);
        $res = $req->send();
        Yii::debug('Ответ: ' . $res->toString(), __METHOD__);

        if (! $res->isOk) {
            throw new Exception('HTTP-error: ' . $res->statusCode);
        }

        $res->format = Client::FORMAT_JSON;

        return new Response([
            'json' => $res->data
        ]);
    }
}
