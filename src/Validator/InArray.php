<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\IValidatable;
use Acelot\Validation\AbstractValidator;

class InArray extends AbstractValidator implements IValidatable
{
    /**
     * @var array
     */
    protected $haystack;

    /**
     * @var string
     */
    protected $template = 'Field value is not contained in the given array';

    /**
     * @param array $haystack
     */
    public function __construct(array $haystack = array())
    {
        $this->haystack = $haystack;
    }

    /**
     * @return boolean
     */
    public function validate($value, $wholeData = null)
    {
        return in_array($value, $this->haystack);
    }
}