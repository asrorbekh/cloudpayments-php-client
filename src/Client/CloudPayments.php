<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Client;

use CloudPaymentsSDK\Http\HttpClient;
use CloudPaymentsSDK\Http\Response;
use CloudPaymentsSDK\Model\Cards\CardsModelResponse;
use CloudPaymentsSDK\Model\Cards\CardsResponse;
use CloudPaymentsSDK\Model\Cards\Confirm3DResponse;
use CloudPaymentsSDK\Model\Tokens\TokensModelResponse;
use CloudPaymentsSDK\Model\Tokens\TokensResponse;

/**
 * Class CloudPayments
 * @author Asrorbek Sultanov asrorbek@asrorbek.uz
 * @link https://developers.cloudpayments.ru/en/
 * @package CloudPaymentsSDK\Client
 */
class CloudPayments
{

    /**
     * Base url of cloud payments UZ domain
     * @const string
     */
    public const CLOUD_PAYMENTS_UZ_URL = 'https://api.cloudpayments.uz';

    /**
     * Base url of cloud payments RU domain
     * @const string
     */
    public const CLOUD_PAYMENTS_RU_URL = 'https://api.cloudpayments.ru';

    /**
     * Test method constant.
     * @const string
     */
    private const METHOD_TEST = '/test';

    /**
     * Capture automatic URL for onetime payment.
     * @const string
     */
    private const CHARGE_CARD = '/payments/cards/charge';

    /**
     * Capture manual URL for onetime payment.
     * @const string
     */
    private const AUTH_CARD = '/payments/cards/auth';

    /**
     * Post 3D secure
     * @const string
     */
    private const POST3D_SECURE = '/payments/cards/post3ds';

    /**
     * Capture automatic URL for token payment (recurring).
     * @const string
     */
    private const CHARGE_TOKEN = '/payments/tokens/charge';

    /**
     * Capture manual URL for token payment (recurring).
     * @const string
     */
    private const AUTH_TOKEN = '/payments/tokens/auth';

    /**
     * @var string $cultureName
     */
    private string $cultureName;

    /**
     * @var HttpClient $httpClient
     */
    private HttpClient $httpClient;

    /**
     * CloudPayments constructor.
     *
     * @param string $publicKey
     * @param string $apiSecret
     * @param string $apiUrl
     * @param bool $enableSSL
     */
    public function __construct(
        string $publicKey,
        string $apiSecret,
        string $apiUrl = self::CLOUD_PAYMENTS_RU_URL,
        bool $enableSSL = true
    ) {
        $this->httpClient = new HttpClient($publicKey, $apiSecret, $apiUrl, $enableSSL);
    }

    /**
     * Make a test request
     *
     * @param array|object $data
     * @return object
     */
    public function sendTestRequest(array|object $data): object
    {
        return $this->httpClient->sendRequest(self::METHOD_TEST, $data);
    }

    /**
     * Make a payment using card details.
     *
     * @param string $paymentEndpoint The API endpoint for the specific payment type
     * @param array|object $cardPaymentData
     * @param bool $model
     * @return string|Confirm3DResponse|CardsResponse|Response
     * @link https://developers.cloudpayments.ru/en/#payment-by-a-cryptogram
     */
    private function processCardPayment(
        string $paymentEndpoint,
        array|object $cardPaymentData,
        bool $model
    ): string|Confirm3DResponse|CardsResponse|Response {
        $response = $this->httpClient->sendRequest($paymentEndpoint, $cardPaymentData);

        if (!$model) {
            return $response;
        }

        if ($response->status) {
            if ($response->data->Message !== null) {
                return $response->data->Message;
            }
            if (!$response->data->Success && (isset($response->data->Model->ReasonCode) && $response->data->Model->ReasonCode > 0)) {
                return $response->data->Model->CardHolderMessage;
            }
            if (isset($response->data->Model->PaReq)) {
                return new Confirm3DResponse($response->data->Model);
            }

            $cardsModel = new CardsModelResponse($response->data->Model);
            return new CardsResponse($cardsModel, $response->data->Success, $response->data->Message);
        }

        return $response->message;
    }

    /**
     * Make a one-time payment using card details.
     *
     * @param array|object $cardAutoPaymentData
     * @param bool $model
     * @return string|Confirm3DResponse|CardsResponse|Response
     * @link https://developers.cloudpayments.ru/en/#payment-by-a-cryptogram
     */
    public function makeCardPaymentAutomatic(
        array|object $cardAutoPaymentData,
        bool $model = false
    ): string|Confirm3DResponse|CardsResponse|Response {
        return $this->processCardPayment(self::CHARGE_CARD, $cardAutoPaymentData, $model);
    }

    /**
     * Make a two-step payment using card details.
     *
     * @param array|object $cardManualPaymentData
     * @param bool $model
     * @return string|Confirm3DResponse|Response|CardsResponse
     * @link https://developers.cloudpayments.ru/en/#payment-by-a-cryptogram
     */
    public function makeCardPaymentManual(
        array|object $cardManualPaymentData,
        bool $model = false
    ): string|Confirm3DResponse|Response|CardsResponse {
        return $this->processCardPayment(self::AUTH_CARD, $cardManualPaymentData, $model);
    }

    /**
     * Make a payment using token details.
     *
     * @param string $paymentEndpoint The API endpoint for the specific payment type
     * @param array|object $tokenPaymentData
     * @param bool $model
     * @return string|Confirm3DResponse|TokensResponse|Response
     * @link https://developers.cloudpayments.ru/en/#payment-by-a-token-recurring
     */
    private function processTokenPayment(
        string $paymentEndpoint,
        array|object $tokenPaymentData,
        bool $model
    ): string|Confirm3DResponse|TokensResponse|Response {
        $response = $this->httpClient->sendRequest($paymentEndpoint, $tokenPaymentData);

        if (!$model) {
            return $response;
        }

        if ($response->status) {
            if ($response->data->Message !== null) {
                return $response->data->Message;
            }
            if (!$response->data->Success && (isset($response->data->Model->ReasonCode) && $response->data->Model->ReasonCode > 0)) {
                return $response->data->Model->CardHolderMessage;
            }
            if (isset($response->data->Model->PaReq)) {
                return new Confirm3DResponse($response->data->Model);
            }

            $cardsModel = new TokensModelResponse($response->data->Model);
            return new TokensResponse($cardsModel, $response->data->Success, $response->data->Message);
        }

        return $response->message;
    }

    /**
     * Make a one-step payment using a token.
     *
     * @param array|object $tokenPaymentData
     * @param bool $model
     * @return string|TokensResponse|Response
     * @link https://developers.cloudpayments.ru/en/#payment-by-a-token-recurring
     */
    public function makeTokenPaymentAutomatic(
        array|object $tokenPaymentData,
        bool $model = false
    ): string|TokensResponse|Response {
        return $this->processTokenPayment(self::CHARGE_TOKEN, $tokenPaymentData, $model);
    }

    /**
     * Make a two-step payment using a token (recurring).
     *
     * @param array|object $tokenPaymentData
     * @param bool $model
     * @return string|TokensResponse|Response
     * @link https://developers.cloudpayments.ru/en/#payment-by-a-token-recurring
     */
    public function makeTokenPaymentManual(
        array|object $tokenPaymentData,
        bool $model = false
    ): string|TokensResponse|Response {
        return $this->processTokenPayment(self::AUTH_TOKEN, $tokenPaymentData, $model);
    }

    /**
     * Completes the payment after 3-D Secure authentication.
     *
     * @param string $transactionId
     * @param string $paRes
     * @return object The response from the CloudPayments API.
     * @link https://developers.cloudpayments.ru/en/#3-d-secure-processing
     */
    public function complete3DSecurePayment(string $transactionId, string $paRes): object
    {
        $requestData = [
            "TransactionId" => $transactionId,
            "PaRes" => $paRes,
        ];
        return $this->httpClient->sendRequest(self::POST3D_SECURE, $requestData);
    }


    /**
     * Confirm a payment with a specific transaction ID and amount.
     *
     * @param string $transactionId
     * @param float $amount
     * @return object
     * @link https://developers.cloudpayments.ru/en/#payment-confirmation
     */
    public function confirmPayment(string $transactionId, float $amount): object
    {
        $endpoint = '/payments/confirm';
        $requestData = [
            "TransactionId" => $transactionId,
            "Amount" => $amount,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * Void a payment with a specific transaction ID.
     *
     * @param string $transactionId
     * @return object
     * @link https://developers.cloudpayments.ru/en/#payment-cancellation
     */
    public function voidPayment(string $transactionId): object
    {
        $endpoint = '/payments/void';
        $requestData = [
            "TransactionId" => $transactionId,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * Refund a payment with a specific transaction ID and amount.
     *
     * @param string $transactionId
     * @param float $amount
     * @return object
     * @link https://developers.cloudpayments.ru/en/#refund
     */
    public function refundPayment(string $transactionId, float $amount): object
    {
        $endpoint = '/payments/refund';
        $requestData = [
            "TransactionId" => $transactionId,
            "Amount" => $amount,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * Initiate a payout using card details.
     *
     * @param array|object $payoutData
     * @return object
     * @link https://developers.cloudpayments.ru/en/#payout-by-a-cryptogram
     */
    public function initiatePayout(array|object $payoutData): object
    {
        $endpoint = '/payments/cards/topup';
        return $this->httpClient->sendRequest($endpoint, $payoutData);
    }

    /**
     * Initiate a payout using a saved card token.
     *
     * @param string $token
     * @param float $amount
     * @param string $accountId
     * @param string $currency
     * @param string|null $payer
     * @param string|null $receiver
     * @param string|null $invoiceId
     * @return object
     * @link https://developers.cloudpayments.ru/en/#payout-by-a-token
     */
    public function initiatePayoutByToken(
        string $token,
        float $amount,
        string $accountId,
        string $currency,
        ?string $payer = null,
        ?string $receiver = null,
        ?string $invoiceId = null
    ): object {
        $endpoint = '/payments/token/topup';
        $requestData = [
            "Token" => $token,
            "Amount" => $amount,
            "AccountId" => $accountId,
            "Currency" => $currency,
            "InvoiceId" => $invoiceId,
            "Payer" => $payer,
            "Receiver" => $receiver,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * Get details for a specific transaction.
     *
     * @param string $transactionId
     * @return object
     * @link https://developers.cloudpayments.ru/en/#transaction-details
     */
    public function getTransactionDetails(string $transactionId): object
    {
        $endpoint = '/payments/get';
        $requestData = [
            "TransactionId" => $transactionId,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * Check the status of a payment using the invoice ID.
     *
     * @param string $invoiceId
     * @return object
     * @link https://developers.cloudpayments.ru/en/#payment-status-check
     */
    public function checkPaymentStatus(string $invoiceId): object
    {
        $endpoint = '/v2/payments/find';
        $requestData = [
            "InvoiceId" => $invoiceId,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * Get a list of transactions for a specific day.
     *
     * @param string $date
     * @param string $timeZone
     * @return object
     * @link https://developers.cloudpayments.ru/en/#transaction-list
     */
    public function getTransactionsForDay(string $date, string $timeZone = "UTC"): object
    {
        $endpoint = '/payments/list';
        $requestData = [
            "Date" => $date,
            "TimeZone" => $timeZone,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * Get a list of transactions for a specific period.
     *
     * @param string $startDate
     * @param string $endDate
     * @param int $pageNumber
     * @param string $timeZone
     * @param array $statuses
     * @return object
     * @link https://developers.cloudpayments.ru/en/#transaction-list
     */
    public function getTransactionsForPeriod(
        string $startDate,
        string $endDate,
        int $pageNumber,
        string $timeZone = "UTC",
        array $statuses = []
    ): object {
        $endpoint = '/v2/payments/list';
        $requestData = [
            "CreatedDateGte" => $startDate,
            "CreatedDateLte" => $endDate,
            "PageNumber" => $pageNumber,
            "TimeZone" => $timeZone,
            "Statuses" => $statuses,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * Get a list of payment tokens.
     *
     * @param int $pageNumber
     * @return object
     * @link https://developers.cloudpayments.ru/en/#token-list
     */
    public function getPaymentTokens(int $pageNumber): object
    {
        $endpoint = '/payments/tokens/list';
        $requestData = [
            "PageNumber" => $pageNumber,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * Create a subscription for recurring payments.
     *
     * @param string $token
     * @param string $accountId
     * @param string $description
     * @param string $email
     * @param float $amount
     * @param string $currency
     * @param bool $requireConfirmation
     * @param string $startDate
     * @param string $interval
     * @param int $period
     * @param int|null $maxPeriods
     * @param string|null $customerReceipt
     * @return object
     * @link https://developers.cloudpayments.ru/en/#creation-of-subscriptions-on-recurrent-payments
     */
    public function createSubscription(
        string $token,
        string $accountId,
        string $description,
        string $email,
        float $amount,
        string $currency,
        bool $requireConfirmation,
        string $startDate,
        string $interval,
        int $period,
        ?int $maxPeriods = null,
        ?string $customerReceipt = null
    ): object {
        $endpoint = '/subscriptions/create';
        $requestData = [
            "Token" => $token,
            "AccountId" => $accountId,
            "Description" => $description,
            "Email" => $email,
            "Amount" => $amount,
            "Currency" => $currency,
            "RequireConfirmation" => $requireConfirmation,
            "StartDate" => $startDate,
            "Interval" => $interval,
            "Period" => $period,
            "MaxPeriods" => $maxPeriods,
            "CustomerReceipt" => $customerReceipt,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * Get information about a subscription.
     *
     * @param string $subscriptionId
     * @return object
     * @link https://developers.cloudpayments.ru/en/#subscription-details
     */
    public function getSubscriptionInfo(string $subscriptionId): object
    {
        $endpoint = '/subscriptions/get';
        $requestData = [
            "Id" => $subscriptionId,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * Find subscriptions for a specific account ID.
     *
     * @param string $accountId
     * @return object
     * @link https://developers.cloudpayments.ru/en/#subscriptions-search
     */
    public function findSubscriptions(string $accountId): object
    {
        $endpoint = '/subscriptions/find';
        $requestData = [
            "accountId" => $accountId,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * Update subscription details.
     *
     * @param string $subscriptionId
     * @param string|null $description
     * @param float|null $amount
     * @param string|null $currency
     * @param bool|null $requireConfirmation
     * @param string|null $startDate
     * @param string|null $interval
     * @param int|null $period
     * @param int|null $maxPeriods
     * @param string|null $customerReceipt
     * @return object
     * @link https://developers.cloudpayments.ru/en/#recurrent-payments-subscription-change
     */
    public function updateSubscription(
        string $subscriptionId,
        ?string $description = null,
        ?float $amount = null,
        ?string $currency = null,
        ?bool $requireConfirmation = null,
        ?string $startDate = null,
        ?string $interval = null,
        ?int $period = null,
        ?int $maxPeriods = null,
        ?string $customerReceipt = null
    ): object {
        $endpoint = '/subscriptions/update';
        $requestData = [
            "Id" => $subscriptionId,
            "Description" => $description,
            "Amount" => $amount,
            "Currency" => $currency,
            "RequireConfirmation" => $requireConfirmation,
            "StartDate" => $startDate,
            "Interval" => $interval,
            "Period" => $period,
            "MaxPeriods" => $maxPeriods,
            "CustomerReceipt" => $customerReceipt,
            "CultureName" => $this->cultureName,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * Cancel a subscription.
     *
     * @param string $subscriptionId
     * @return object
     * @link https://developers.cloudpayments.ru/en/#subscription-on-recurrent-payments-cancellation
     */
    public function cancelSubscription(string $subscriptionId): object
    {
        $endpoint = '/subscriptions/cancel';
        $requestData = [
            "Id" => $subscriptionId,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * Create an invoice for a one-time payment.
     *
     * @param float $amount
     * @param string $currency
     * @param string $description
     * @param string $email
     * @param bool $requireConfirmation
     * @param bool $sendEmail
     * @param string|null $invoiceId
     * @param string|null $accountId
     * @param string|null $offerUri
     * @param string|null $phone
     * @param bool|null $sendSms
     * @param bool|null $sendViber
     * @param string|null $subscriptionBehavior
     * @param string|null $successRedirectUrl
     * @param string|null $failRedirectUrl
     * @param array|null $jsonData
     * @return object
     * @link https://developers.cloudpayments.ru/en/#invoice-creation-on-email
     */
    public function createInvoice(
        float $amount,
        string $currency,
        string $description,
        string $email,
        bool $requireConfirmation,
        bool $sendEmail,
        ?string $invoiceId = null,
        ?string $accountId = null,
        ?string $offerUri = null,
        ?string $phone = null,
        ?bool $sendSms = null,
        ?bool $sendViber = null,
        ?string $subscriptionBehavior = null,
        ?string $successRedirectUrl = null,
        ?string $failRedirectUrl = null,
        ?array $jsonData = null
    ): object {
        $endpoint = '/orders/create';
        $requestData = [
            "Amount" => $amount,
            "Currency" => $currency,
            "Description" => $description,
            "Email" => $email,
            "RequireConfirmation" => $requireConfirmation,
            "SendEmail" => $sendEmail,
            "InvoiceId" => $invoiceId,
            "AccountId" => $accountId,
            "OfferUri" => $offerUri,
            "Phone" => $phone,
            "SendSms" => $sendSms,
            "SendViber" => $sendViber,
            "CultureName" => $this->cultureName,
            "SubscriptionBehavior" => $subscriptionBehavior,
            "SuccessRedirectUrl" => $successRedirectUrl,
            "FailRedirectUrl" => $failRedirectUrl,
            "JsonData" => $jsonData,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * Cancel an order for a one-time payment.
     *
     * @param string $orderId
     * @return object
     * @link https://developers.cloudpayments.ru/en/#created-invoice-cancellation
     */
    public function cancelOrder(string $orderId): object
    {
        $endpoint = '/orders/cancel';
        $requestData = [
            "Id" => $orderId,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * View notification settings for a specific notification type.
     *
     * @param string $notificationType
     * @return object
     * @link https://developers.cloudpayments.ru/en/#view-of-notification-settings
     */
    public function viewNotificationSettings(string $notificationType): object
    {
        $endpoint = "/site/notifications/{$notificationType}/get";
        $requestData = [
            "Type" => $notificationType,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * Updates notification settings for a specific notification type.
     *
     * @param string $notificationType Type of the notification.
     * @param bool|null $isEnabled Whether the notification is enabled.
     * @param string|null $address Notification endpoint address.
     * @param string|null $httpMethod HTTP method for the notification.
     * @param string|null $encoding Encoding for the notification.
     * @param string|null $format Format of the notification.
     * @return object Response from the CloudPayments API.
     * @link https://developers.cloudpayments.ru/en/#change-of-notification-settings
     */
    public function updateNotificationSettings(
        string $notificationType,
        bool $isEnabled = null,
        string $address = null,
        string $httpMethod = null,
        string $encoding = null,
        string $format = null
    ): object {
        $endpoint = "/site/notifications/$notificationType/update";
        $requestData = [
            "Type" => $notificationType,
            "IsEnabled" => $isEnabled,
            "Address" => $address,
            "HttpMethod" => $httpMethod,
            "Encoding" => $encoding,
            "Format" => $format,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * Initiates an Apple Pay session.
     *
     * @param string $validationUrl Validation URL for Apple Pay.
     * @param string|null $paymentUrl Payment URL for Apple Pay.
     * @return object Response from the CloudPayments API.
     * @link https://developers.cloudpayments.ru/en/#start-of-apple-pay-session
     */
    public function startApplePaySession(string $validationUrl, string|null $paymentUrl = null): object
    {
        $endpoint = '/applepay/startsession';
        $requestData = [
            "ValidationUrl" => $validationUrl,
            "PaymentUrl" => $paymentUrl,
        ];
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }

    /**
     * Sets the localization for the API requests.
     *
     * @param string $cultureName The culture name for localization.
     * @return void
     * @link https://developers.cloudpayments.ru/en/#localization
     */
    public function setLocalization(string $cultureName): void
    {
        $this->cultureName = $cultureName;
    }

    /**
     * Gets the localization for the API requests.
     *
     * @return string
     * @link https://developers.cloudpayments.ru/en/#localization
     */
    public function getLocalization(): string
    {
        return $this->cultureName;
    }
}
