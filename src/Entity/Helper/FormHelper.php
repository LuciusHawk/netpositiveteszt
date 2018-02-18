<?php
namespace App\Entity\Helper;

class FormHelper
{
    private $handle1;
    private $handle2;
    private $method = 'fib';

    /**
     * Icndb constructor.
     */
    public function __construct()
    {
        
    }

    /**
     * @return mixed
     */
    public function getHandle1()
    {
        return $this->handle1;
    }

    /**
     * @param mixed $handle1
     */
    public function setHandle1($handle1)
    {
        $this->handle1 = $handle1;
    }

    /**
     * @return mixed
     */
    public function getHandle2()
    {
        return $this->handle2;
    }

    /**
     * @param mixed $handle2
     */
    public function setHandle2($handle2)
    {
        $this->handle2 = $handle2;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }


}