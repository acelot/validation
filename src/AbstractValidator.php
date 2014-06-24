<?php
/**
 * Created by PhpStorm.
 * User: pioneer
 * Date: 23.06.14
 * Time: 19:54
 */

namespace Acelot\Validation;

abstract class AbstractValidator
{
    /**
     * @var string
     */
    protected $template;

    /**
     * @param string $template
     * @return mixed
     */
    public function getMessage($template = null)
    {
        return preg_replace_callback(
            '/{([\w\d_]+)}/',
            function ($matches) {
                if (isset($this->$matches[1])) {
                    return $this->$matches[1];
                }

                return $matches[0];
            },
            $template ? $template : $this->template
        );
    }
}