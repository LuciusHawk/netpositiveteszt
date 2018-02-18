<?php
namespace App\Entity;

class IcndbRecord
{
    private $message;

    /**
     * Icndb constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}