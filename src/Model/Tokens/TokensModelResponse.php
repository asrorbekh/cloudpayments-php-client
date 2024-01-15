<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Model\Tokens;

class TokensModelResponse
{
    public int $TransactionId;
    public float $Amount;
    public string $Currency;
    public int $CurrencyCode;
    public string $InvoiceId;
    public string $AccountId;
    public ?string $Email;
    public string $Description;
    public ?string $JsonData;
    public string $CreatedDate;
    public string $CreatedDateIso;
    public bool $TestMode;
    public string $IpAddress;
    public string $IpCountry;
    public string $IpCity;
    public string $IpRegion;
    public string $IpDistrict;
    public float $IpLatitude;
    public float $IpLongitude;
    public string $CardFirstSix;
    public string $CardLastFour;
    public string $CardType;
    public int $CardTypeCode;
    public string $Issuer;
    public string $IssuerBankCountry;
    public string $Status;
    public int $StatusCode;
    public ?string $Reason;
    public ?int $ReasonCode;
    public ?string $CardHolderMessage;
    public ?string $Name;

    // Token-specific fields
    public ?string $AuthDate;
    public ?string $AuthDateIso;
    public ?string $ConfirmDate;
    public ?string $ConfirmDateIso;
    public ?string $AuthCode;
    public ?string $Token;

    public function __construct(object|array $data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
