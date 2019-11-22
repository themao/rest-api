<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\CartService;
use AppBundle\Service\CurrencyExchangeService;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CartServiceTest extends KernelTestCase
{
    const CURRENCY_RATES = [
        'success' => true,
        'timestamp' => 1574366346,
        'base' => 'EUR',
        'date' => '2019-11-21',
        // only EUR and USD for testing purposes, real response contains much more currencies
        'rates' => [
            'EUR' => 1,
            'USD' => 1.105987,
        ],
    ];

    /**
     * @dataProvider cartInput
     * @throws \Exception
     */
    public function testCalculateConvertedSummary($input)
    {
        $logger = $this->createMock(Logger::class);
        $currencyExchangeService = $this->createMock(CurrencyExchangeService::class);
        $currencyExchangeService
            ->expects(self::any())
            ->method('getExchangeRates')
            ->willReturn(json_decode(json_encode(self::CURRENCY_RATES)))
        ;

        $cartService = new CartService($currencyExchangeService, $logger);
        $summary = $cartService->calculateConvertedSummary(json_encode($input));

        self::assertArrayHasKey('checkoutPrice', $summary);
        self::assertArrayHasKey('checkoutCurrency', $summary);
        self::assertEquals(82.54, $summary['checkoutPrice']);
        self::assertEquals('EUR', $summary['checkoutCurrency']);
    }

    public function cartInput()
    {
        $properInput = [
            'items' => [
                42 => [
                    'currency' => 'EUR',
                    'price' => 49.99,
                    'quantity' => 1,
                ],
                55 => [
                    'currency' => 'USD',
                    'price' => 12,
                    'quantity' => 3,
                ],
            ],
            'checkoutCurrency' => 'EUR',
        ];

        $toBeRoundedInput = [
            'items' => [
                42 => [
                    'currency' => 'EUR',
                    'price' => 49.990000001,
                    'quantity' => 1,
                ],
                55 => [
                    'currency' => 'USD',
                    'price' => 12.000000001,
                    'quantity' => 3,
                ],
            ],
            'checkoutCurrency' => 'EUR',
        ];

        return [
            [$properInput],
            [$toBeRoundedInput],
        ];
    }
}
