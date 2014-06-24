<?php

namespace Acelot\Validation\Exception;

use Acelot\Validation\Validation;

class ValidationRequiredFieldMissingException extends ValidationException
{
    /**
     * @var array
     */
    protected $missingFields;

    /**
     * @param Validation $validation
     * @param array $missingFields
     */
    public function __construct(Validation $validation, array $missingFields)
    {
        parent::__construct($validation);
        $this->missingFields = $missingFields;
    }

    /**
     * @return array
     */
    public function getMissingFields()
    {
        return $this->missingFields;
    }
}