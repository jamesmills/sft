<?php

namespace Sensio\StoreBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Quotation
 * @package Sensio\StoreBundle\Quotation
 */
class Quotation
{

    private $entries;

    /** @Assert\Valid() */
    private $customer;

    /**
     * @Assert\File(mimeTypes={"application/pdf" })
     */
    private $document;

    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="string",message="Amount must be a valid number")
     */
    private $amount;

    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="string",message="VAT must be a valid number")
     */
    private $vat;

    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="string",message="Total must be a valid number")
     */
    private $total;

    public function __construct()
    {
        $this->amount = 0;
        $this->vat = 0;
        $this->total = 0;

        $this->setEntries(
            array(
                new Entry(),
                new Entry(),
                new Entry(),
                new Entry(),
                new Entry()
            )
        );
    }

    /**
     * @param mixed $document
     */
    public function setDocument(UploadedFile $document)
    {
        $this->document = $document;
    }

    /**
     * @return mixed
     */
    public function getDocument()
    {
        return $this->document;
    }



    public function getRecipient()
    {
        return array(
            $this->customer->getEmail() => $this->customer->getName()
        );
    }

    public function setEntries($entries)
    {
        $this->entries = array();
        foreach ($entries as $entry) {
            $this->entries[] = $entry;
        }
    }

    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }


    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $vat
     */
    public function setVat($vat)
    {
        $this->vat = $vat;
    }

    /**
     * @return mixed
     */
    public function getVat()
    {
        return $this->vat;
    }

}
