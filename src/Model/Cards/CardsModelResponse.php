<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Model\Cards;

class CardsModelResponse
{
    public int $TransactionId;
    public float $Amount;
    public string $Currency;
    public int $CurrencyCode;
    public ?float $PaymentAmount;
    public ?string $PaymentCurrency;
    public ?int $PaymentCurrencyCode;
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
    public string $CardExpDate;
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
    public ?string $Token;

    public function __construct(object|array $Model)
    {
        foreach ($Model as $key => $value) {
            $this->{$key} = $value;
        }
    }
}