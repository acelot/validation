<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\IValidatable;
use Acelot\Validation\AbstractValidator;

class IntegerRange extends AbstractValidator implements IValidatable
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
     * @var int
     */
    protected $step;

    /**
     * @var string
     */
    protected $template = 'Field value must be in the range from {min} to {max}';

    /**
     * @param int $min
     * @param int $max
     */
    public function __construct($min, $max, $step = 1)
    {
        if (!is_int($min) || !is_int($max) || !is_int($step)) {
            throw new \InvalidArgumentException('Arguments must be an integers');
        }

        $this->min = $min;
        $this->max = $max;
        $this->step = $step;
    }

    /**
     * @return boolean
     */
    public function validate($value, $wholeData = null)
    {
        $value = intval($value);

        return in_array($value, range($this->min, $this->max, $this->step));
    }
}