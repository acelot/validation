<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\Validator;

class IntegerRange extends Validator
{
    /**
     * @var int
     */
    protected $min;

    /**
     * @var int
     */
    protected $max;

    /**
     * @var string
     */
    protected $template = 'Field value must be in the range from {min} to {max}';

    /**
     * @param int $min
     * @param int $max
     */
    public function __construct($min, $max)
    {
        if (!is_int($min) || !is_int($max)) {
            throw new \InvalidArgumentException('Arguments must be an integers');
        }

        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @return boolean
     */
    public function validate($value, $wholeData = null)
    {
        $value = intval($value);

        return $value >= $this->min && $value <= $this->max;
    }
}