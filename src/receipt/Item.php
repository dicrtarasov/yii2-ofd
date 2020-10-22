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
 * Class Item
 */
class Item extends JsonEntity
{
    /** @var string наименование товара (Шок батончик Сникерс) */
    public $name;

    /** @var int количество (3) */
    public $quantity;

    /** @var float цена за единицу с учетом скидок и наценок (994.03) */
    public $price;

    /** @var ?float сумма (часть итога), к которой применяется ставка 18% (536) */
    public $nds18;

    /** @var ?float сумма (часть итога), к которой применяется ставка 10% (193) */
    public $nds10;

    /** @var ?float сумма НДС по расч. ставке 18/118 (176) */
    public $ndsCalculated18;

    /** @var ?float сумма НДС по расч. ставке 10/110 (66) */
    public $ndsCalculated10;

    /** @var ?float сумма, не облагаемая НДС (7720) */
    public $ndsNo;

    /** @var float стоимость товара с учетом скидок и наценок (2982.23) */
    public $sum;

    /**
     * @inheritDoc
     */
    public function attributeFields() : array
    {
        return [];
    }
}
