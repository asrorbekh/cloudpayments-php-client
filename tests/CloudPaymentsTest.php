<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Tests;

use CloudPaymentsSDK\Client\CloudPayments;
use PHPUnit\Framework\TestCase;

class CloudPaymentsTest extends TestCase
{
    /**
     * @var CloudPayments
     */
    private CloudPayments $cloudPayments;

    protected function setUp(): void
    {
        parent::setUp();

        $this->cloudPayments = new CloudPayments('pk_123456abcedf', 'abcdefg');
    }

    public function testSendTestRequest(): void
    {
        $testData = [
            'key' => 'value',
        ];

        $result = $this->cloudPayments->sendTestRequest($testData);

        $this->assertInstanceOf(\stdClass::class, $result);
    }

}