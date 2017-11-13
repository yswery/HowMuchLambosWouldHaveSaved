<?php

namespace App\Http\Controllers;

use App\Calculator\AccumulatedTimeSeries;
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
        $savingsPeriod       = $request->get('savingsPeriod', 12);

        // 4.33 weeks per month average
        $savingsPeriodWeeks = ceil($savingsPeriod * 4.33);

        $accumulatedSeries = new AccumulatedTimeSeries($savingsPeriodWeeks, $weeklyDepositAmount);
        $accumulatedMoney  = $accumulatedSeries->generate();

        // ####  DO THE SAME for the BTC value

        return view('home', compact('savingsPeriodWeeks', 'accumulatedMoney'));
    }
}
