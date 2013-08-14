<?php

namespace Sensio\StoreBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Entry
{

    /** @Assert\NotBlank() */
    private $designation;

    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="string", message="Unit price must be a number")
     */
    private $unitPrice;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/\d+/", message="Quantity ... integer")
     * @Assert\Range(min=1)
     */
    private $quantity;

    public function __construct()
    {
        $this->quantity = 1;
    }

    public function getTotal()
    {
        return $this->quantity * $this->unitPrice;
    }

    /**
     * @param mixed $designation
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;
    }

    /**
     * @return mixed
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $unitPrice
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * @return mixed
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }



}