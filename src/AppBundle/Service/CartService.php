<?php

namespace AppBundle\Service;

use Psr\Log\LoggerInterface;

class CartService
{
    /** @var CurrencyExchangeService */
    private $currencyExchangeService;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(CurrencyExchangeService $currencyExchangeService, LoggerInterface $logger)
    {
        $this->currencyExchangeService = $currencyExchangeService;
        $this->logger = $logger;
    }

    /**
     * @param string $data JSON with input data
     * @throws \Exception
     * @return array
     */
    public function calculateConvertedSummary($data)
    {
        $summary = [
            'checkoutPrice' => 0,
            'checkoutCurrency' => 'EUR',
        ];
        $decodedData = json_decode($data);

        if (!isset($decodedData->items)) {
            throw new \Exception('Input data has to contain items.');
        }

        $rates = $this->currencyExchangeService->getExchangeRates();

        if (!isset($rates->rates)) {
            throw new \Exception('Exchange rates have to contain items.');
        }

        foreach ($decodedData->items as $item) {
            if (isset($rates->rates->{$item->currency})) {
                $summary['checkoutPrice'] += $item->price * $item->quantity / $rates->rates->{$item->currency};
            } else {
                $this->logger->warn('No rate found for currency: ' . $item->currency);
            }
        }

        $summary['checkoutPrice'] = round($summary['checkoutPrice'], 2);

        return $summary;
    }
}
