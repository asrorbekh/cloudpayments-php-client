<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Client;

use CloudPaymentsSDK\Http\HttpClient;
use CloudPaymentsSDK\Util\Localization;

/**
 * Class AbstractCloudPayments
 * @package CloudPaymentsSDK\Client
 */
abstract class AbstractCloudPayments
{
    /**
     * Base url of cloud payments UZ domain
     * @const string
     */
    public const CLOUD_PAYMENTS_UZ_URL = 'https://api.cloudpayments.uz';

    /**
     * Base url of cloud payments EU domain
     * @const string
     */
    public const CLOUD_PAYMENTS_EU_URL = 'https://api.cloudpayments.eu';

    /**
     * Base url of cloud payments RU domain
     * @const string
     * @default Url of this SDK
     */
    public const CLOUD_PAYMENTS_RU_URL = 'https://api.cloudpayments.ru';

    /**
     * Test method constant.
     * @const string
     */
    protected const METHOD_TEST = '/test';

    /**
     * Capture automatic URL for onetime payment.
     * @const string
     */
    protected const CHARGE_CARD = '/payments/cards/charge';

    /**
     * Capture manual URL for onetime payment.
     * @const string
     */
    protected const AUTH_CARD = '/payments/cards/auth';

    /**
     * Post 3D secure
     * @const string
     */
    protected const POST3D_SECURE = '/payments/cards/post3ds';

    /**
     * Capture automatic URL for token payment (recurring).
     * @const string
     */
    protected const CHARGE_TOKEN = '/payments/tokens/charge';

    /**
     * Capture manual URL for token payment (recurring).
     * @const string
     */
    protected const AUTH_TOKEN = '/payments/tokens/auth';

    /**
     * @var string $cultureName
     * @default en-US
     */
    protected string $cultureName = Localization::ENGLISH;

    /**
     * @var HttpClient $httpClient
     */
    protected HttpClient $httpClient;

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
        bool $enableSSL = false
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
}
