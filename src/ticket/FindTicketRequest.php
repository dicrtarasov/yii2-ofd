<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 23.10.20 01:25:02
 */

declare(strict_types = 1);
namespace dicr\ofd\ticket;

use dicr\helper\JsonEntity;
use dicr\validate\ValidateException;
use Yii;
use yii\base\Exception;
use yii\httpclient\Client;

/**
 * Запрос поиска ID чека.
 */
class FindTicketRequest extends JsonEntity
{
    /** @var string номер фискального документа (i) */
    public $fiscalDocumentNumber;

    /** @var string фискальный признак документа (fp) */
    public $fiscalId;

    /** @var string серийный номер фискального накопителя (fn) */
    public $fiscalDriveId;

    /** @var OfdTicketClient */
    private $client;

    /**
     * FindTicketRequest constructor.
     *
     * @param OfdTicketClient $client
     * @param array $config
     */
    public function __construct(OfdTicketClient $client, array $config = [])
    {
        $this->client = $client;

        parent::__construct($config);
    }

    /**
     * @inheritDoc
     */
    public function attributeFields() : array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function rules() : array
    {
        return [
            ['fiscalDocumentNumber', 'required'],
            ['fiscalDocumentNumber', 'number', 'min' => 1],
            ['fiscalDocumentNumber', 'filter', 'filter' => 'strval'],

            ['fiscalId', 'required'],
            ['fiscalId', 'number', 'min' => 1],
            ['fiscalId', 'filter', 'filter' => 'strval'],

            ['fiscalDriveId', 'required'],
            ['fiscalDriveId', 'number', 'min' => 1],
            ['fiscalDriveId', 'filter', 'filter' => 'strval']
        ];
    }

    /**
     * Отправка запроса.
     *
     * @return FindTicketResponse
     * @throws Exception
     */
    public function send() : FindTicketResponse
    {
        if (! $this->validate()) {
            throw new ValidateException($this);
        }

        $req = $this->client->httpClient->post('find-ticket', $this->json);
        $req->format = Client::FORMAT_JSON;

        Yii::debug('Запрос: ' . $req->toString(), __METHOD__);
        $res = $req->send();
        Yii::debug('Ответ: ' . $res->toString(), __METHOD__);

        if (! $res->isOk) {
            throw new Exception('HTTP-error: ' . $res->statusCode);
        }

        $res->format = Client::FORMAT_JSON;

        return new FindTicketResponse([
            'json' => $res->data
        ]);
    }
}
