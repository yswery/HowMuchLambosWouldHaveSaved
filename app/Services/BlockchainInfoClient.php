<?php

namespace App\Services;

use GuzzleHttp\Client as GuzzleClient;

class BlockchainInfoClient
{

    /**
     * The blockchain.info base api URL
     *
     * @var string
     */
    private $apiUrl = 'https://blockchain.info/charts/market-price';

    /**
     * The Guzzle API client
     *
     * @var GuzzleClient
     */
    protected $guzzleClient;

    /**
     * API Client constructor giving ability to set the timespan
     *
     * @param int $timeSpanMonths The timespan for the daily price in months
     */
    public function __construct(GuzzleClient $guzzleClient = null)
    {
        $this->guzzleClient = $guzzleClient ?? new GuzzleClient();
    }

    /**
     * Fetching the daily price dataset giving ability to set the timespan
     *
     *
     * @return Array $response The price list array
     */
    public function getDailyPrices()
    {
        $response = $this->guzzleClient->request('GET', $this->apiUrl, [
            'query' => [
                'format'   => 'json',
                'timespan' => 'all'
            ],
        ]);

        return json_decode($response->getBody());
    }

}
