<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Util;

/**
 * Class ErrorCode
 *
 * This class defines error codes, their names, reasons, and messages for payment rejection.
 *
 * @package CloudPaymentsSDK\Util
 * @link https://developers.cloudpayments.ru/en/#error-codes
 */
class ReasonErrorCode
{
    // Payment Error Codes
    public const REFER_TO_CARD_ISSUER = '5001';
    public const INVALID_MERCHANT = '5003';
    public const PICK_UP_CARD = '5004';
    public const DO_NOT_HONOR = '5005';
    public const ERROR = '5006';
    public const PICK_UP_CARD_SPECIAL_CONDITIONS = '5007';
    public const INVALID_TRANSACTION = '5012';
    public const AMOUNT_ERROR = '5013';
    public const INVALID_CARD_NUMBER = '5014';
    public const NO_SUCH_ISSUER = '5015';
    public const TRANSACTION_ERROR = '5019';
    public const FORMAT_ERROR = '5030';
    public const BANK_NOT_SUPPORTED_BY_SWITCH = '5031';
    public const EXPIRED_CARD_PICKUP = '5033';
    public const SUSPECTED_FRAUD = '5034';
    public const RESTRICTED_CARD = '5036';
    public const LOST_CARD = '5041';
    public const STOLEN_CARD = '5043';
    public const INSUFFICIENT_FUNDS = '5051';
    public const EXPIRED_CARD = '5054';
    public const TRANSACTION_NOT_PERMITTED = '5057';
    public const RESTRICTED_CARD_2 = '5062';
    public const SECURITY_VIOLATION = '5063';
    public const EXCEED_WITHDRAWAL_FREQUENCY = '5065';
    public const INCORRECT_CVV = '5082';
    public const TIMEOUT = '5091';
    public const CANNOT_REACH_NETWORK = '5092';
    public const SYSTEM_ERROR = '5096';
    public const UNABLE_TO_PROCESS = '5204';
    public const AUTHENTICATION_FAILED = '5206';
    public const AUTHENTICATION_UNAVAILABLE = '5207';
    public const ANTI_FRAUD = '5300';

    // Check Notification Error Codes
    public const INVALID_INVOICE_ID = '3001';
    public const INVALID_ACCOUNT_ID = '3002';
    public const INVALID_AMOUNT = '3003';
    public const OUT_OF_DATE = '3004';
    public const FORMAT_ERROR_CHECK = '3005';
    public const UNAVAILABLE = '3006';
    public const UNABLE_TO_CONNECT = '3007';
    public const NOT_ACCEPTED = '3008';
}
