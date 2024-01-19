<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Model\Cards;

class Confirm3DResponse
{
    public int $TransactionId;
    public string $PaReq;
    public string $AcsUrl;
    public ?string $GoReq;
    public ?string $ThreeDsSessionData;
    public bool $IFrameIsAllowed;
    public ?int $FrameWidth;
    public ?int $FrameHeight;
    public ?string $ThreeDsCallbackId;
    public ?string $EscrowAccumulationId;

    public function __construct(object|array $Model)
    {
        foreach ($Model as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
