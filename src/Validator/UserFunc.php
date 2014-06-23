<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\Validator;

class UserFunc extends Validator
{
    protected $function;
    protected $template;

    public function __construct(callable $function)
    {
        $this->function = $function;
        $this->template = get_class($function);
    }

    /**
     * @return boolean
     */
    public function validate($value, $wholeData = null)
    {
        return call_user_func($this->function, $value);
    }
}