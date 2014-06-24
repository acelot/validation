<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\IValidatable;
use Acelot\Validation\AbstractValidator;

class EqualTo extends AbstractValidator implements IValidatable
{
    /**
     * @var string
     */
    protected $compareField;

    /**
     * @var string
     */
    protected $template = 'Field is not equal with {compareField}';

    /**
     * @param string $compareField
     */
    public function __construct($compareField)
    {
        $this->compareField = $compareField;
    }

    /**
     * @param string $value
     * @param array $wholeData
     * @return bool
     */
    public function validate($value, $wholeData = null)
    {
        if (!isset($wholeData[$this->compareField])) {
            return false;
        }

        return $value == $wholeData[$this->compareField];
    }
}