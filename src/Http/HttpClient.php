<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Http;

use Curl\Curl;

/**
 * HttpClient for making requests to CloudPayments API using cURL with enhanced error handling and response formatting.
 */
class HttpClient
{
    /**
     * @var Curl $curl cURL instance for making HTTP requests.
     * @link https://github.com/php-curl-class/php-curl-class
     */
    private Curl $curl;

    /**
     * HttpClient constructor.
     *
     * @param string|null $publicKey CloudPayments public key.
     * @param string|null $apiSecret CloudPayments API secret key.
     * @param string|null $apiUrl CloudPayments API base URL.
     * @param bool|null $enableSSL Flag indicating whether SSL verification is enabled.
     */
    public function __construct(
        private readonly string|null $publicKey = null,
        private readonly string|null $apiSecret = null,
        private readonly string|null $apiUrl = null,
        private readonly bool|null $enableSSL = true,
    ) {
        $this->curl = new Curl();
    }

    /**
     * Sends an HTTP request to the CloudPayments API.
     *
     * @param string|null $url Relative URL for the API endpoint.
     * @param array|object|null $data Data to be sent in the request body.
     * @param string $method HTTP method for the request (default is "POST").
     *
     * @return Response Response object with status, data, message, and code.
     */
    public function sendRequest(?string $url = null, array|object|null $data = null, string $method = "POST"): Response
    {
        $responseObject = new Response();
        $responseObject->status = false;
        $responseObject->data = null;

        if (!$data) {
            $responseObject->message = 'Invalid data params.';
            $responseObject->code = 400;
            return $responseObject;
        }

        try {
            $fullUrl = $this->apiUrl ? $this->apiUrl . $url : $url;

            $ua = $_SERVER['HTTP_USER_AGENT'] ?? 'CloudPayments PHP Client';

            $headers = [
                "Content-Type: application/json",
                "Accept: application/json",
                "User-Agent: $ua",
            ];

            $this->curl->setOpt(CURLOPT_RETURNTRANSFER, true);
            $this->curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
            $this->curl->setOpt(CURLOPT_SSL_VERIFYHOST, $this->enableSSL ? 2 : 0);
            $this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, $this->enableSSL);

            $this->curl->setOpt(CURLOPT_CUSTOMREQUEST, $method);
            $this->curl->setOpt(CURLOPT_URL, $fullUrl);
            $this->curl->setOpt(CURLOPT_POSTFIELDS, json_encode($data));
            $this->curl->setOpt(CURLOPT_HTTPHEADER, $headers);

            $this->curl->setBasicAuthentication($this->publicKey, $this->apiSecret);

            $response = $this->curl->exec();

            $responseObject->code = $this->curl->getHttpStatusCode();
            $responseObject->data = $response;

            if ($this->curl->error) {
                $responseObject->message = $this->curl->getCurlErrorMessage();
                $responseObject->code = $this->curl->getCurlErrorCode();
            } else {
                $responseObject->status = true;
                $responseObject->message = 'OK';
            }
        } catch (\Exception $exception) {
            $responseObject->message = $exception->getMessage();
            $responseObject->code = $exception->getCode();
        } finally {
            $this->curl->close();
        }

        return $responseObject;
    }
}
