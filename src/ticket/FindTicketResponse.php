<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 22.10.20 22:40:12
 */

declare(strict_types = 1);
namespace dicr\ofd\ticket;

use dicr\helper\JsonEntity;

/**
 * Ответ на поиск чека.
 */
class FindTicketResponse extends JsonEntity
{
    /** @var int найден */
    public const STATUS_FOUND = 1;

    /** @var int не найден */
    public const STATUS_NOT_FOUND = 2;

    /** @var string 1C ID чека */
    public $uid;

    /** @var int статус поиска */
    public $status;
}
