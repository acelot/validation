<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\Validator;

class MinLength extends Validator
{
    protected $minLength;
    protected $template = 'Field must be shorter than {maxLength} characters';

    public function __construct($minLength) {
        $this->minLength = $minLength;
    }

    /**
     * @return boolean
     */
    public function validate($value, $wholeData = null)
    {
        return strlen($value) >= $this->minLength;
    }
}