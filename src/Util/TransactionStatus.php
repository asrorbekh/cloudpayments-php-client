<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Util;

/**
 * Class TransactionStatus
 *
 * This class defines transaction statuses, their descriptions, use cases, and possible actions.
 *
 * @package CloudPaymentsSDK\Util
 * @link https://developers.cloudpayments.ru/en/#transaction-statuses
 */
class TransactionStatus
{
    /**
     * Awaiting Authentication status.
     * When a payer is visiting an issuer's website while waiting for 3-D Secure results.
     * No actions are available in this state.
     */
    public const AWAITING_AUTHENTICATION = 'AwaitingAuthentication';

    /**
     * Authorized status.
     * Represents the state when the transaction is authorized.
     * Possible actions: Confirm, Cancel.
     */
    public const AUTHORIZED = 'Authorized';

    /**
     * Completed status.
     * Indicates the completion of the operation after confirmation.
     * Possible action: Refund.
     */
    public const COMPLETED = 'Completed';

    /**
     * Cancelled status.
     * Used in case of cancellation of the operation.
     * No actions are available in this state.
     */
    public const CANCELLED = 'Cancelled';

    /**
     * Declined status.
     * Indicates the failure to complete the transaction (e.g., Insufficient Funds).
     * No actions are available in this state.
     */
    public const DECLINED = 'Declined';
}

