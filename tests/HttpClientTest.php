<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Tests;

use CloudPaymentsSDK\Http\HttpClient;
use PHPUnit\Framework\TestCase;

class HttpClientTest extends TestCase
{
    public function testSendRequest(): void
    {
        $httpClient = new HttpClient();

        $endpoint = 'https://example.com';
        $data = ['key' => 'value'];

        $result = $httpClient->sendRequest($endpoint, $data, 'GET');

        $this->assertInstanceOf(\stdClass::class, $result);
        $this->assertObjectHasProperty('status', $result);
        $this->assertFalse($result->status);

    }

}