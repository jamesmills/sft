<?php

namespace Sensio\TrainingBundle\Converter;

class TempConverter
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function toFahrenheit()
    {
        return ($this->value * 9) / 5 + 32;
    }

    public function getValue()
    {
        return $this->value;
    }
}
