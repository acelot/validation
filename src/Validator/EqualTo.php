<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\Validator;

class EqualTo extends Validator
{
    protected $compareField;
    protected $template = 'Field is not equal with {compareField}';

    public function __construct($compareField)
    {
        $this->compareField = $compareField;
    }

    /**
     * @return boolean
     */
    public function validate($value, $wholeData = null)
    {
        return $value == $wholeData[$this->compareField];
    }
}