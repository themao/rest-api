<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testCurrencyExchange()
    {
        $client = static::createClient();

        $inputJson = '{"items":{"42":{"currency":"EUR","price":49.99,"quantity":1},"55":{"currency":"USD","price":12,'
            .'"quantity":3}},"checkoutCurrency":"EUR"}';
        $client->request('POST', '/api/cart/exchange', [], [], [], $inputJson);

        $this->assertFalse($client->getResponse()->isEmpty());
    }
}
