<?php
/**
 * Created by PhpStorm.
 * User: 2A
 * Date: 20-08-16
 * Time: 9:54 PM
 */

namespace App\Http\BusinessLogic\patient\chart;


use JsonSerializable;

class BalanceChartObject implements JsonSerializable
{

    protected $overBudget;
    protected $performedCurePrize;
    protected $toPerformCurePrize;
    protected $totalPayment;
    protected $discount;

    /**
     * BalanceChartObject constructor.
     * @param $overBudget
     * @param $performedCurePrize
     * @param $toPerformCurePrize
     * @param $totalPayment
     */
    public function __construct($overBudget, $performedCurePrize, $toPerformCurePrize, $discount, $totalPayment)
    {
        $this->overBudget = $overBudget;
        $this->performedCurePrize = $performedCurePrize;
        $this->toPerformCurePrize = $toPerformCurePrize;
        $this->totalPayment = $totalPayment;
        $this->discount = $discount;
    }

    /**
     * @return mixed
     */
    public function getOverBudget()
    {
        return $this->overBudget;
    }

    /**
     * @param mixed $overBudget
     */
    public function setOverBudget($overBudget)
    {
        $this->overBudget = $overBudget;
    }

    /**
     * @return mixed
     */
    public function getPerformedCurePrize()
    {
        return $this->performedCurePrize;
    }

    /**
     * @param mixed $performedCurePrize
     */
    public function setPerformedCurePrize($performedCurePrize)
    {
        $this->performedCurePrize = $performedCurePrize;
    }

    /**
     * @return mixed
     */
    public function getToPerformCurePrize()
    {
        return $this->toPerformCurePrize;
    }

    /**
     * @param mixed $toPerformCurePrize
     */
    public function setToPerformCurePrize($toPerformCurePrize)
    {
        $this->toPerformCurePrize = $toPerformCurePrize;
    }

    /**
     * @return mixed
     */
    public function getTotalPayment()
    {
        return $this->totalPayment;
    }

    /**
     * @param mixed $totalPayment
     */
    public function setTotalPayment($totalPayment)
    {
        $this->totalPayment = $totalPayment;
    }

    /**
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param mixed $discount
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return array(
            'overBudget'            => $this->overBudget,
            'performedCurePrize'    => $this->performedCurePrize,
            'toPerformCurePrize'    => $this->toPerformCurePrize,
            'totalPayment'          => $this->totalPayment,
            'discount'              => $this->discount,
        );
    }
}