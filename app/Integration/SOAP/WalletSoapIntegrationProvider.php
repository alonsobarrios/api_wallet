<?php

namespace App\Integration\SOAP;

use App\Integration\IntegrationProvider;

class WalletSoapIntegrationProvider implements IntegrationProvider
{
    /**
     * @var \SoapClient
     */
    private $soap;

    /**
     * 
     * @throws \Exception
     */
    public function __construct()
    {
        $url = config('soap_wallet.url');
        if (!$url) {
            throw new \Exception('No url soap wallet config');
        }

        $this->soap = new \SoapClient($url);
    }

    /**
     * @param object $response
     * @return arrray
     */
    private function getResponse(object $response): array
    {
        $response = (array)$response->item;

        $data = [];
        foreach ($response as $key => $value) {
            if ($value->key == 'data') {
                $arrayData = $value->value ? (array)$value->value->item ?? [] : [];

                if (isset($arrayData['key'])) {
                    $data[$value->key][$arrayData['key']] = $arrayData['value'];
                } else if (isset($arrayData[0]) && gettype($arrayData[0]) == 'object') {
                    foreach ($arrayData as $keyData => $valueData) {
                        $data[$value->key][$valueData->key] = $valueData->value;
                    }
                } else {
                    $data[$value->key] = [];
                }
            } else {
                $data[$value->key] = $value->value;
            }
        }

        return $data;
    }

    public function registerCustomer(array $data): array
    {
        $resp = $this->getResponse($this->soap->registerCustomer(...$data));
        return $resp;
    }

    public function rechargeWallet(array $data): array
    {
        $resp = $this->getResponse($this->soap->rechargeWallet(...$data));
        return $resp;
    }

    public function makePayment(array $data): array
    {
        $resp = $this->getResponse($this->soap->makePayment(...$data));
        return $resp;
    }

    public function confirmPayment(array $data): array
    {
        $resp = $this->getResponse($this->soap->confirmPayment(...$data));
        return $resp;
    }

    /**
     * @param array $params
     * @return array
     */
    public function checkBalance(array $params): array
    {
        $resp = $this->getResponse($this->soap->checkBalance($params['document'] ?? '', $params['phone'] ?? ''));
        return $resp;
    }
}