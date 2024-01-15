<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Util;

/**
 * Class SubscriptionStatus
 *
 * This class defines subscription statuses, their descriptions, usage conditions, and possible actions.
 *
 * @package CloudPaymentsSDK\Util
 * @link https://developers.cloudpayments.ru/en/#subscription-statuses-recurrents
 */
class SubscriptionStatus
{
    /**
     * Active status.
     * Indicates that the subscription is active.
     * It is used when a subscription is created and/or payment by subscription is done.
     * Possible action: Cancel.
     */
    public const ACTIVE = 'Active';

    /**
     * PastDue status.
     * Represents that the subscription is expired.
     * It is used after one or two consecutive unsuccessful payment attempts.
     * Possible action: Cancel.
     */
    public const PAST_DUE = 'PastDue';

    /**
     * Cancelled status.
     * Indicates that the subscription is cancelled upon request.
     * No actions are available in this state.
     */
    public const CANCELLED = 'Cancelled';

    /**
     * Rejected status.
     * Represents the state after three unsuccessful back-to-back payment attempts.
     * No actions are available in this state.
     */
    public const REJECTED = 'Rejected';

    /**
     * Expired status.
     * Indicates the completion of the maximum number of periods (if specified).
     * No actions are available in this state.
     */
    public const EXPIRED = 'Expired';
}

