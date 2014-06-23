<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\Validator;

class NotBlank extends Validator
{
    protected $template = 'The field can not be empty';

    /**
     * @return boolean
     */
    public function validate($value, $wholeData = null)
    {
        return strlen($value) > 0;
    }
}