<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 22.10.20 23:02:08
 */

declare(strict_types = 1);
namespace dicr\ofd\ticket;

use dicr\helper\JsonEntity;
use dicr\validate\ValidateException;
use Yii;
use yii\base\Exception;
use yii\httpclient\Client;

/**
 * Запрос получения информации о чеке.
 */
class GetTicketRequest extends JsonEntity
{
    /** @var string 1C-ID чека */
    public $uid;

    /** @var OfdTicketClient */
    private $client;

    /**
     * GetTicketRequest constructor.
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
            ['uid', 'required'],
            ['uid', 'string', 'length' => 36]
        ];
    }

    /**
     * Отправка запроса.
     *
     * @return array JSON-данные
     * @throws Exception
     * @see doc/ticket_get_response.json
     */
    public function send() : array
    {
        if (! $this->validate()) {
            throw new ValidateException($this);
        }

        $req = $this->client->httpClient->get('ticket/' . $this->uid);

        Yii::debug('Запрос: ' . $req->toString(), __METHOD__);
        $res = $req->send();
        Yii::debug('Ответ: ' . $res->toString(), __METHOD__);

        if (! $res->isOk) {
            throw new Exception('HTTP-error: ' . $res->statusCode);
        }

        $res->format = Client::FORMAT_JSON;

        return $res->data;
    }
}
