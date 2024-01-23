<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Util;

/**
 * Class CloudKassirErrorCode
 *
 * This class defines error codes and their descriptions for CloudKassir.
 *
 * @package CloudPaymentsSDK\Util
 * @link [CloudKassir Error Codes](#) // Insert link when available
 */
class CloudKassirErrorCode
{
    // Error Codes
    public const UNKNOWN_ERROR = -1;
    public const MISSING_KKT = 2;
    public const TAX_SYSTEM_NOT_SET = 3;
    public const MISSING_AGENT_DATA = 4;
    public const MISSING_SUPPLIER_INN_OR_PHONE = 5;
    public const AGENT_PAYMENT_NOT_ALLOWED = 6;
    public const INVALID_SUPPLIER_INN_FORMAT = 7;
    public const DOCUMENT_STORAGE_EXHAUSTED = 8;
    public const AGENT_DATA_ERROR = 9;
    public const UNENCRYPTED_PERSONAL_DATA = 10;
    public const MISSING_INN = 11;
    public const MISSING_ITEMS_INFORMATION = 12;
    public const PAYMENT_AMOUNT_LESS_THAN_TOTAL = 13;
    public const NON_CASH_PAYMENT_GREATER_THAN_TOTAL = 14;
    public const NO_SUITABLE_KKT = 15;
    public const NO_KKT_WITH_MATCHING_TERMINAL = 16;
    public const NO_KKT_WITH_BSO_ATTRIBUTE = 17;
    public const NO_KKT_WITHOUT_BSO_ATTRIBUTE = 18;
    public const NO_KKT_SUPPORTING_CASH_PAYMENT = 19;
    public const NO_KKT_WITH_AGENT_ATTRIBUTE = 20;
    public const NO_KKT_WITH_ADDITIONAL_USER_ATTRIBUTE = 21;
    public const TEST_CHECK_LIMIT_EXCEEDED = 22;
    public const INVALID_PRICE_FORMAT = 23;
    public const INVALID_EMAIL_FORMAT = 24;

    // Warning Codes
    public const CRYPTO_PROCESSOR_ERROR = 1;
    public const FISCAL_STORAGE_EXPIRED = 2;
    public const OFD_SEND_QUEUE_OVERFLOW = 3;
    public const FISCAL_STORAGE_BUFFER_OVERFLOW = 4;
    public const CASHIER_ERROR = 5;
}
