<?php
/**
 * Created by PhpStorm.
 * User: kutya
 * Date: 2018. 02. 18.
 * Time: 2:34
 */

namespace App\Entity\Helper;


class FibonacciHelper
{
    private $prevNumber = 2;
    private $nextNumber = 3;
    private $currentNumber;

    /**
     * FibonacciHelper constructor.
     */
    public function __construct()
    {
    }

    private function setNextNumber()
    {
        $this->nextNumber = $this->prevNumber + $this->currentNumber;
    }

    private function setPrevNumber()
    {
        $this->prevNumber = $this->currentNumber;
    }

    /**
     * @param $number
     * @return bool
     */
    public function isFibonacciNumber($number)
    {
        $isNextFibNumber = ($number === $this->nextNumber);
        if ($isNextFibNumber) {
            $this->currentNumber = $number;
            $this->setNextNumber();
            $this->setPrevNumber();
        }
        return $isNextFibNumber;
    }
}