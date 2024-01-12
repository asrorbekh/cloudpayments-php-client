# CloudPayments PHP Client

This PHP library provides a convenient interface for interacting with the CloudPayments API. The CloudPayments API operates at `api.cloudpayments.ru` and supports various functions for payment processing, including making a payment, canceling a payment, returning money, completing payments made using a two-stage scheme, creating and canceling subscriptions for recurring payments, as well as sending invoices by mail.

## Principle of Operation

Parameters are passed using the POST method in the body of the request in either the "key=value" format or in JSON. The API can accept a maximum of 150,000 fields in a single request, and the timeout for receiving a response from the API is set to 5 minutes. It's important to note that if a number with a fractional part is passed into an integer field, mathematical rounding will occur without triggering an error.

The API enforces limits on the maximum number of simultaneous requests for test terminals (5) and combat terminals (30). If the number of requests to the site currently being processed exceeds the limit, the API will return a response with HTTP code 429 (Too Many Requests) until processing is completed. For a review of these restrictions, contact your personal manager.

The choice of parameter transfer format is determined on the client side and is controlled through the `Content-Type` request header:
- For `key=value` parameters: `Content-Type: application/x-www-form-urlencoded`
- For JSON parameters: `Content-Type: application/json`

The system issues a response in JSON format, including at least two parameters: `Success` and `Message`:

```json
{
  "Success": false,
  "Message": "Invalid Amount value"
}
```

### Request Authentication

To authenticate the request, HTTP Basic Auth is used. The login and password are sent in the HTTP request header. The Public ID serves as the login, and the API Secret serves as the password. Both values can be obtained in your personal account. If a header with authentication data is not sent in the request or incorrect data is provided, the system will return HTTP status 401 – Unauthorized. It's crucial to securely store the API secret.

### Requires

- php ^8.1

```bash
composer require asrorbek/cloudpayments-php-client
```

## Example usage

```php
<?php

use CloudPaymentsSDK\Client\CloudPayments;

require_once __DIR__ . '/vendor/autoload.php';

// .ru - CloudPayments::CLOUD_PAYMENTS_RU_URL
// .uz - CloudPayments::CLOUD_PAYMENTS_UZ_URL

$cloudPayments = new CloudPayments(publicKey: 'your_public_key', apiSecret: 'your_api_secret', apiUrl: CloudPayments::CLOUD_PAYMENTS_RU_URL, enableSSL: true);

$response = $cloudPayments->sendTestRequest(array(
    'Name' => 'Foo Baz',
));

print_r($response);


// Process the response as needed

```

- Replace 'your_public_key' and 'your_api_secret' with the actual Public ID and API Secret obtained from your personal account.
