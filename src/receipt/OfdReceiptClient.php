<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 22.10.20 22:26:25
 */

declare(strict_types = 1);
namespace dicr\ofd\receipt;

use dicr\http\CachingClient;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * Клиент Receipt-API 1-ofd.ru
 *
 * @property-read CachingClient $httpClient
 */
class OfdReceiptClient extends Component
{
    /** @var string API endpoint URL */
    public const URL_API = 'https://receipt.1-ofd.ru:44380/rent/api/v2';

    /** @var string API Url */
    public $url = self::URL_API;

    /** @var string ключ API */
    public $apiKey;

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

        if (empty($this->apiKey)) {
            throw new InvalidConfigException('apiKey');
        }
    }

    /** @var CachingClient */
    private $_httpClient;

    /**
     * HTTP-клиент.
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
     * QR-запрос.
     *
     * @param array $config
     * @return Request
     */
    public function qrRequest(array $config = []) : Request
    {
        return new Request($this, $config);
    }
}
