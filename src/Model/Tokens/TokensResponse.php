<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Model\Tokens;

class TokensResponse
{
    public function __construct(
        public TokensModelResponse $Model,
        public bool $Success,
        public ?string $Message,
    ) {
    }
}