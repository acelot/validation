<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\IValidatable;
use Acelot\Validation\AbstractValidator;

class Integer extends AbstractValidator implements IValidatable
{
    /**
     * @var bool
     */
    protected $unsigned;

    /**
     * @var string
     */
    protected $template = 'Field must be an integer';

    /**
     * @param bool $unsigned
     */
    public function __construct($unsigned = true)
    {
        $this->unsigned = $unsigned;
    }

    /**
     * @return boolean
     */
    public function validate($value, $wholeData = null)
    {
        $pattern = $this->unsigned ? '/^\d+$/' : '/^-?\d+$/';
        return (new Regex($pattern))->validate($value);
    }
}