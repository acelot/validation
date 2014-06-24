<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\Validator;

class MinLength extends Validator
{
    /**
     * @var int
     */
    protected $minLength;

    /**
     * @var string
     */
    protected $template = 'Field must be shorter than {maxLength} characters';

    /**
     * @param int $minLength
     */
    public function __construct($minLength) {
        $this->minLength = $minLength;
    }

    /**
     * @param string $value
     * @param array $wholeData
     * @return bool
     */
    public function validate($value, $wholeData = null)
    {
        return strlen($value) >= $this->minLength;
    }
}