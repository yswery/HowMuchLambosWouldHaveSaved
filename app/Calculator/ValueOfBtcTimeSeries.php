<?php

namespace App\Calculator;

use App\Services\BlockchainInfoClient;

class ValueOfBtcTimeSeries
{

    /**
     * Number of weeks we save for
     *
     * @var BlockchainInfoClient
     */
    protected $blockchainInfoClient;

    /**
     * Number of weeks we save for
     *
     * @var int
     */
    protected $savingsPeriodWeeks;

    /**
     * Weekly deposit amount
     *
     * @var int
     */
    protected $weeklyDepositAmount;

    /**
     * Accumulated Btc balance
     *
     * @var float
     */
    public $accumulatedBtc;

    /**
     * Last Btc Price
     *
     * @var float
     */
    public $lastBtcPrice;

    /**
     * ValueOfBtcTimeSeries constructor
     *
     * @param BlockchainInfoClient $blockchainInfoClient
     * @param int $savingsPeriodWeeks
     * @param int $weeklyDepositAmount
     */
    public function __construct($savingsPeriodWeeks, $weeklyDepositAmount, BlockchainInfoClient $blockchainInfoClient = null)
    {
        $this->savingsPeriodWeeks   = $savingsPeriodWeeks;
        $this->weeklyDepositAmount  = $weeklyDepositAmount;
        $this->blockchainInfoClient = $blockchainInfoClient ?? new BlockchainInfoClient();
    }

    /**
     * Generate the chart-able BTC value
     *
     * @return Array $btcSavingsCombined
     */
    public function generate()
    {
        $accumulatedBtcValue = [];
        $btcPrices           = $this->blockchainInfoClient->getDailyPrices()->values;
        $this->lastBtcPrice  = end($btcPrices)->y;

        foreach (range(1, $this->savingsPeriodWeeks) as $iteration) {
            // Get the BTC price at the time of the week
            $weeklyBtcPrice = $btcPrices[count($btcPrices) - $iteration * 7]->y;

            // Calculate the total BTC the weeklyDepositAmount would get you that week.
            $weeklyBtcAmountPurchased = $this->weeklyDepositAmount / $weeklyBtcPrice;

            // Add to total btc balance
            $this->accumulatedBtc += $weeklyBtcAmountPurchased;

            $accumulatedBtcValue[] = $weeklyBtcAmountPurchased * $this->lastBtcPrice;
        }

        // Flip the weeks savings
        $accumulatedBtcValue = array_reverse($accumulatedBtcValue);

        // Combined the savings
        $btcSavingsCombined = [];
        foreach ($accumulatedBtcValue as $value) {
            $btcSavingsCombined[] = end($btcSavingsCombined) + $value;
        }

        return $btcSavingsCombined;
    }

}
