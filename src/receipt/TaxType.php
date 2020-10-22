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
 * Тип системы налогообложения.
 */
interface TaxType
{
    /** @var int общая */
    public const COMMON = 0;

    /** @var int упрощенная доход */
    public const SIMPLE_INCOME = 1;

    /** @var int упрощенная доход минус расход */
    public const SIMPLE_INCOME_EXPENSE = 2;

    /** @var int единый налог на вмененный доход */
    public const SINGLE_INCOME = 3;

    /** @var int единый сельскохозяйственный налог */
    public const SINGLE_AGRICULTURAL = 4;

    /** @var int патентная система налогообложения */
    public const PATENT = 5;
}
