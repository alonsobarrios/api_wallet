<?php

namespace App\Integration;

interface IntegrationProvider
{
    /**
    * @param array $data
    * @return array
    */
    public function registerCustomer(array $data): array;

    /**
     * @param array $data
     * @return array
     */
    public function rechargeWallet(array $data): array;

    /**
     * @param array $data
     * @return array
     */
    public function makePayment(array $data): array;

    /**
     * @param array $data
     * @return array
     */
    public function confirmPayment(array $data): array;

    /**
     * @param array $params
     * @return array
     */
    public function checkBalance(array $params): array;

}