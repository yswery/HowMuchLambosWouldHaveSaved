<?php

namespace App\Http\Controllers;

use App\Calculator\AccumulatedTimeSeries;
use App\Calculator\ValueOfBtcTimeSeries;
use Illuminate\Http\Request;

class BtcSavingsCalculator extends Controller
{
    /**
     * The rendering controller for taking in the period and amount HTTP params
     *
     * @param Request $request request object
     *
     * @return View
     */
    public function index(Request $request)
    {
        $weeklyDepositAmount = $request->get('weeklyAmount', 20);
        $savingsPeriodMonths = $request->get('savingsPeriod', 12);

        // 4.33 weeks per month average
        $savingsPeriodWeeks = ceil($savingsPeriodMonths * 4.33);

        $accumulatedSeries = new AccumulatedTimeSeries($savingsPeriodWeeks, $weeklyDepositAmount);
        $accumulatedMoney  = $accumulatedSeries->generate();

        $valueOfBtcSeries = new ValueOfBtcTimeSeries($savingsPeriodWeeks, $weeklyDepositAmount);
        $valueOfBtcSaved  = $valueOfBtcSeries->generate();

        $btcBalance   = $valueOfBtcSeries->accumulatedBtc;
        $lastBtcPrice = $valueOfBtcSeries->lastBtcPrice;

        return view('home', compact('savingsPeriodWeeks', 'accumulatedMoney', 'valueOfBtcSaved', 'btcBalance', 'lastBtcPrice', 'weeklyDepositAmount', 'savingsPeriodMonths'));
    }
}
