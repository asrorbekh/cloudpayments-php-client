<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Util;

/**
 * Class NotificationTypes
 *
 * This class provides a list of notification types with their corresponding codes.
 *
 * @package CloudPaymentsSDK\Util
 * @link https://developers.cloudpayments.ru/en/#notification-types
 */
class NotificationTypes
{
    public const CHECK = 'Check';
    public const PAY = 'Pay';
    public const FAIL = 'Fail';
    public const CONFIRM = 'Confirm';
    public const REFUND = 'Refund';
    public const RECURRENT = 'Recurrent';
    public const CANCEL = 'Cancel';
}

