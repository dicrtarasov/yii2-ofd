<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 22.10.20 22:19:21
 */

declare(strict_types = 1);
namespace dicr\ofd\receipt;

/**
 * Тип операции.
 */
interface OperationType
{
    /** @var int приход */
    public const INCOME = 1;

    /** @var int возврат прихода */
    public const INCOME_RETURN = 2;

    /** @var int расход */
    public const EXPENSE = 3;

    /** @var int возврат расхода */
    public const EXPENSE_RETURN = 4;

    /** @var string[] */
    public const VALUES = [
        self::INCOME => 'приход',
        self::INCOME_RETURN => 'возврат прихода',
        self::EXPENSE => 'расход',
        self::EXPENSE_RETURN => 'возврат расхода'
    ];
}
