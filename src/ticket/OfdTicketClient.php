<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 22.10.20 23:11:44
 */

declare(strict_types = 1);
namespace dicr\ofd\ticket;

use dicr\http\CachingClient;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * Клиент Ticket-API 1-ofd.ru
 *
 * @property-read CachingClient $httpClient
 * @link https://consumer.1-ofd.ru/
 * @link https://open-budget.ru/public/647711/
 * @link https://www.1-ofd.ru/blog/news/nash-ezhenedelnyy-daydzhest-voprosy-otvety-20201005/
 */
class OfdTicketClient extends Component
{
    /** @var string API URL */
    public const API_URL = 'https://consumer.1-ofd.ru/api/tickets';

    /** @var string API URL */
    public $url = self::API_URL;

    /** @var CachingClient */
    private $_httpClient;

    /**
     * @inheritDoc
     * @throws InvalidConfigException
     */
    public function init() : void
    {
        parent::init();

        if (empty($this->url)) {
            throw new InvalidConfigException('url');
        }
    }

    /**
     * Клиент HTTP.
     *
     * @return CachingClient
     */
    public function getHttpClient() : CachingClient
    {
        if ($this->_httpClient === null) {
            $this->_httpClient = new CachingClient();
        }

        $this->_httpClient->baseUrl = $this->url;

        return $this->_httpClient;
    }

    /**
     * Запрос поиска ID чека.
     *
     * @param array $config
     * @return FindTicketRequest
     */
    public function findTicketRequest(array $config = []) : FindTicketRequest
    {
        return new FindTicketRequest($this, $config);
    }

    /**
     * Запрос информации по чеку.
     *
     * @param array $config
     * @return GetTicketRequest
     */
    public function getTicketRequest(array $config = []) : GetTicketRequest
    {
        return new GetTicketRequest($this, $config);
    }
}
