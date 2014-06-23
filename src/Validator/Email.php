<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\Validator;

class Email extends Validator
{
    protected $template = 'Invalid email';

    /**
     * @return boolean
     */
    public function validate($value, $wholeData = null)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}