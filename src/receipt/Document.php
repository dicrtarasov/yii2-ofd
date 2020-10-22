<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 22.10.20 22:19:21
 */

declare(strict_types = 1);
namespace dicr\ofd\receipt;

use dicr\helper\JsonEntity;

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
            'receipt' => Receipt::class
        ];
    }
}
