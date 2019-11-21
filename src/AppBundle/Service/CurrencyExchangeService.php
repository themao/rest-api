<?php

namespace AppBundle\Service;

use GuzzleHttp\Client as GuzzleClient;

class CurrencyExchangeService
{
    /** @var string */
    private $apiUrl;

    /** @var string */
    private $apiKey;

    /** @var GuzzleClient */
    private $client;

    /**
     * @param string $apiUrl
     * @param string $apiKey
     */
    public function __construct($apiUrl, $apiKey)
    {
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
        $this->client = new GuzzleClient(['base_uri' => $this->apiUrl]);
    }

    /**
     * @return mixed
     */
    public function getExchangeRates()
    {
        $response = $this->client->get('/api/latest?access_key=' . $this->apiKey);

        return json_decode($response->getBody()->getContents());
    }
}
