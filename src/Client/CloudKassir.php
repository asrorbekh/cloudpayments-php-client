<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Client;

use CloudPaymentsSDK\Http\Response;

/**
 * Class CloudKassir
 * @package CloudPaymentsSDK\Client
 */
class CloudKassir extends AbstractCloudPayments
{
    /**
     * Fiscalize a cash register.
     *
     * @param array|object $fiscalizeData
     * @return object
     * @link https://developers.cloudkassir.ru/en/#register-fiscalization
     */
    public function fiscalizeCashRegister(array|object $fiscalizeData): object
    {
        $endpoint = '/kkt/fiscalize';
        return $this->httpClient->sendRequest($endpoint, $fiscalizeData);
    }

    /**
     * Form a cash receipt.
     *
     * @param array|object $receiptData
     * @return Response
     * @link https://developers.cloudkassir.ru/en/#online-receipt-generation
     */
    public function formCashReceipt(array|object $receiptData): Response
    {
        $endpoint = '/kkt/receipt';

        return $this->httpClient->sendRequest($endpoint, $receiptData);
    }

    /**
     * Get receipt status.
     *
     * @param array|object $statusData
     * @return Response
     * @link https://developers.cloudkassir.ru/en/#receipt-status-request
     */
    public function getReceiptStatus(array|object $statusData): Response
    {
        $endpoint = '/kkt/receipt/status/get';
        return $this->httpClient->sendRequest($endpoint, $statusData);
    }

    /**
     * Get receipt details.
     *
     * @param array|object $detailsData
     * @return Response
     * @link https://developers.cloudkassir.ru/en/#receipt-details-request
     */
    public function getReceiptDetails(array|object $detailsData): Response
    {
        $endpoint = '/kkt/receipt/get';
        return $this->httpClient->sendRequest($endpoint, $detailsData);
    }

    /**
     * Form a correction receipt.
     *
     * @param array|object $correctionData
     * @return Response
     * @link https://developers.cloudkassir.ru/#formirovanie-cheka-korrektsii
     */
    public function formCorrectionReceipt(array|object $correctionData): Response
    {
        $endpoint = '/kkt/correction-receipt';
        return $this->httpClient->sendRequest($endpoint, $correctionData);
    }

    /**
     * Manage cash register state.
     *
     * @param array|object $stateData
     * @return Response
     * @link https://developers.cloudkassir.ru/en/#cash-register-state-change
     */
    public function manageCashRegisterState(array|object $stateData): Response
    {
        $endpoint = '/kkt/state';
        return $this->httpClient->sendRequest($endpoint, $stateData);
    }

    /**
     * Get cash register data.
     *
     * @param array|object $requestData
     * @return Response
     * @link https://developers.cloudkassir.ru/en/#receiving-cash-register-data
     */
    public function getCashRegisterData(array|object $requestData): Response
    {
        $endpoint = '/kkt/state/get';
        return $this->httpClient->sendRequest($endpoint, $requestData);
    }
}
