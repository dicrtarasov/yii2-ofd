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
class Receipt extends JsonEntity
{
    /** @var string заводской номер фискального накопителя (0000270761025003) */
    public $fiscalDriveNumber;

    /**
     * @var int (1)
     * @see OperationType
     */
    public $operationType;

    /** @var float сумма, уплаченная наличными (7262) */
    public $cashTotalSum;

    /** @var int номер смены (1) */
    public $shiftNumber;

    /** @var string регистрационный номер ККТ (0000270761025003) */
    public $kktRegId;

    /** @var int сумма НДС по расч. ставке 10/110 (66) */
    public $ndsCalculated10;

    /** @var Item[] список товаров */
    public $items;

    /** @var float сумма, не облагаемая НДС (7720) */
    public $ndsNo;

    /** @var float общая итоговая сумма в чеках (14524) */
    public $totalSum;

    /** @var float сумма (часть итога), к которой применяется ставка 10% (193) */
    public $nds10;

    /** @var string ИНН оператора перевода (123456789099) */
    public $operatorInnToTransfer;

    /** @var float сумма уплаченная электронными средствами платежа (7262) */
    public $ecashTotalSum;

    /** @var float сумма НДС по расч. ставке 18/118 (176) */
    public $ndsCalculated18;

    /** @var float сумма (часть итога), к которой применяется ставка 18% (536) */
    public $nds18;

    /** @var string ИНН пользователя (332766738956) */
    public $userInn;

    /** @var string дата и время осуществления расчета (2018-09-18T14:25:22) */
    public $dateTime;

    /** @var int код документа "кассовый чек" (всегда равен 3) (3) */
    public $receiptCode;

    /**
     * @var int тип системы налогообложения (1)
     * @see TaxType
     */
    public $taxationType;

    /** @var int фискальный признак документа (3109549042) */
    public $fiscalSign;

    /** @var int номер чека за смену (64) */
    public $requestNumber;

    /** @var string кассир (Краснова Любовь Игоревна) */
    public $operator;

    /** @var string телефон или электронный адрес покупателя (latov@gocom.ru) */
    public $buyerPhoneOrAddress;

    /** @var string заводской номер фискального накопителя (137280722) */
    public $fiscalDocumentNumber;

    /** @var string наименование пользователя (ООО Продукты) */
    public $user;

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
            'item' => [Item::class]
        ];
    }
}
