<?php

namespace App\Http\BusinessLogic\patient\chart;

use App\Domain;

class CalculateListCuresLogic
{
    /**
     * CalculateListCuresLogic constructor.
     */
    public function __construct() { }

    /**
     * Calculate all variables to the chart modal for the list of cure
     * @param $listCure
     * return array() with 2 items, $listCure and object (with variables of costs)
     */
    public function calculateAllVariablesListCure($listCure)
    {

        $statusCureNotCount = Domain::findOrFail(40);
        $statusCurePerformed = Domain::findOrFail(37);

        $overBudget = 0;
        $performedCurePrize = 0;
        $toPerformCurePrize = 0;
        $totalPayment = 0;

        foreach ($listCure as $cure) {

            // Do not count
            if ($cure->status_cure != $statusCureNotCount->shortDesc) {

                $overBudget   += $cure->amount;
                $totalPayment += $cure->amount;

                if ($cure->status_cure == $statusCurePerformed->shortDesc) {
                    $performedCurePrize += $cure->amount;
                }
            }

        }
        $toPerformCurePrize = $totalPayment - $performedCurePrize;

        $balancedListCureOfPatient = new BalanceChartObject($overBudget, $performedCurePrize, $toPerformCurePrize, 0, $totalPayment);

        $arrayListAndBoject = array($listCure, json_encode($balancedListCureOfPatient) );

        return $arrayListAndBoject;
    }

}
