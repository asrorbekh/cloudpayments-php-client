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
    /**
     * The Check notification is performed once a cardholder filled in a payment form and pressed the “Pay” button.
     * It serves the purpose of payment validation: the system sends a request to a merchant's website address with payment information,
     * and the website must validate and define if it's needed to confirm or reject the payment.
     */
    public const CHECK = 'Check';

    /**
     * The Pay notification is performed once a payment is successfully completed and an issuer's authorization is received.
     *
     * It serves the purpose of information about a payment: the system sends a request to a merchant's
     * website address with payment information, and the merchant's site has to register the fact of payment.
     */
    public const PAY = 'Pay';

    /**
     * The Fail notification is performed if a payment was declined and is used to analyze a number and causes of failures.
     *
     * You need to consider that a fact of decline is not final since a user can pay the second time.
     */
    public const FAIL = 'Fail';

    /**
     * The Confirm notification is performed by the DMS scheme.
     * @link https://developers.cloudpayments.ru/en/#payment-schemes
     */
    public const CONFIRM = 'Confirm';

    /**
     * The Refund notification is performed if a payment was refunded (fully or partially) on your initiative via the API or Back Office.
    */
    public const REFUND = 'Refund';

    /**
     * The Recurrent notification is performed if the recurring payment subscription status was changed.
     */
    public const RECURRENT = 'Recurrent';

    /**
     * The Cancel notification is performed by the DMS scheme once payment was canceled via the API or Back Office.
     * @link https://developers.cloudpayments.ru/en/#payment-schemes
     * @api https://developers.cloudpayments.ru/en/#api
    */
    public const CANCEL = 'Cancel';
}

