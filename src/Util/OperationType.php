<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Util;

/**
 * Class OperationType
 *
 * This class defines operation types and their corresponding codes in notifications.
 *
 * @package CloudPaymentsSDK\Util
 * @link https://developers.cloudpayments.ru/en/#operation-types
 */
class OperationType
{
    /**
     * Code representing a payment operation.
     */
    public const PAYMENT = 'Payment';

    /**
     * Code representing a refund operation.
     */
    public const REFUND = 'Refund';

    /**
     * Code representing a card payout operation.
     */
    public const CARD_PAYOUT = 'CardPayout';
}
