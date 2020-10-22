<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 22.10.20 22:22:53
 */

declare(strict_types = 1);
namespace dicr\ofd\receipt;

use dicr\helper\JsonEntity;

/**
 * Ответ на запрос информации о чеке по QR-коду.
 */
class Response extends JsonEntity
{
    /** @var Document */
    public $document;

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
    public function attributeEntities() : array
    {
        return [
            'document' => Document::class
        ];
    }
}
