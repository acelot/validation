<?php

namespace Acelot\Validation\Exception;

use Acelot\Validation\Validation;

class ValidationException extends \Exception {

    protected $validation;

    public function __construct(Validation $validation)
    {
        $this->validation = $validation;
    }

    /**
     * @return array
     */
    public function getErrors($messages = array())
    {
        return $this->validation->getErrors($messages);
    }
}