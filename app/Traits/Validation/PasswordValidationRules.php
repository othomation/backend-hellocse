<?php

namespace App\Traits\Validation;

trait PasswordValidationRules
{
    /** 
     * Basic password rules for validation
     */
    protected $passwordValidationsRules = [
        "required",
        "min:12"
    ];
}
