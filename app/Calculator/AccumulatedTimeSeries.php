<?php

namespace App\Calculator;

class AccumulatedTimeSeries
{

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
     * AccumulatedTimeSeries constructor
     *
     * @param int $savingsPeriodWeeks
     * @param int $weeklyDepositAmount
     */
    public function __construct($savingsPeriodWeeks, $weeklyDepositAmount)
    {
        $this->savingsPeriodWeeks       = $savingsPeriodWeeks;
        $this->weeklyDepositAmount = $weeklyDepositAmount;
    }

    /**
     * Generate the chartable savings
     *
     * @return Array $accumulatedMoney
     */
    public function generate()
    {

        // Get Accumulated money deposited
        $accumulatedMoney = [];
        foreach (range(1, $this->savingsPeriodWeeks) as $iteration) {
            $accumulatedMoney[] = $this->weeklyDepositAmount * $iteration;
        }

        return $accumulatedMoney;
    }

}
