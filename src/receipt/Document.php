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

/**
 * Class Document
 */
class Document extends JsonEntity
{
    /** @var ?Receipt тип фискального документа - кассовый чек (в данном методе всегда) */
    public $receipt;

    /**
     * @inheritDoc
     */
    public static function attributeFields() : array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public static function attributeEntities() : array
    {
        return [
            'receipt' => Receipt::class
        ];
    }
}
