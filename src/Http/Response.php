<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Http;

/**
 * Class Response
 *
 * Represents the response from CloudPayments API.
 *
 * @package CloudPaymentsSDK\Http
 */
class Response
{
    /**
     * @var bool Indicates the status of the API response.
     */
    public bool $status = false;

    /**
     * @var mixed|null Contains the data returned in the API response.
     */
    public mixed $data = null;

    /**
     * @var string Represents a human-readable message related to the API response.
     */
    public string $message = '';

    /**
     * @var int|null Represents the HTTP status code of the API response.
     */
    public int|null $code = 0;
}