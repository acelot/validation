<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\Validator;

class MaxLength extends Validator
{
    protected $maxLength;
    protected $template = 'Field must be longer than {maxLength} characters';

    public function __construct($maxLength) {
        $this->maxLength = $maxLength;
    }

    /**
     * @return boolean
     */
    public function validate($value, $wholeData = null)
    {
        return strlen($value) <= $this->maxLength;
    }
}