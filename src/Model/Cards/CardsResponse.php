<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Model\Cards;

class CardsResponse
{
    public function __construct(
        public CardsModelResponse $Model,
        public bool $Success,
        public ?string $Message
    ) {
    }
}