<?php

namespace App\Services;

class BlockchainInfoClient
{

    /**
     * The blockchain.info base api URL
     *
     * @var string
     */
    private $apiUrl = 'https://blockchain.info/charts/market-price?';

    /**
     * API Client constructor giving ability to set the timespan
     *
     * @param int $timeSpanMonths The timespan for the daily price in months
     */
    public function __construct($timeSpanMonths = 18)
    {
        $this->apiUrl .= http_build_query([
            'format' => 'json',
            'timespan' => sprintf('%dmonths', $timeSpanMonths)
        ]);
    }



}
