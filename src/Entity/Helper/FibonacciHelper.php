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
    private $prevNumber = 1;
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
        if ($number == $this->nextNumber) {
            $this->currentNumber = $this->nextNumber;
            $this->setNextNumber();
            $this->setPrevNumber();
            return true;
        }
        return false;
    }
}