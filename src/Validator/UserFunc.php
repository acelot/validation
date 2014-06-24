<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\IValidatable;
use Acelot\Validation\AbstractValidator;

class UserFunc extends AbstractValidator implements IValidatable
{
    /**
     * @var callable
     */
    protected $function;

    /**
     * @var string
     */
    protected $template;

    /**
     * @param callable $function
     */
    public function __construct(callable $function)
    {
        $this->function = $function;
        $this->template = get_class($function);
    }

    /**
     * @param string $value
     * @param array $wholeData
     * @return mixed
     */
    public function validate($value, $wholeData = null)
    {
        return call_user_func($this->function, $value);
    }
}