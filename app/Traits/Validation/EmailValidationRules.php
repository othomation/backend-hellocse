<?php

namespace App\Traits\Validation;

use App\Models\User;
use Illuminate\Validation\Rule;

trait EmailValidationRules
{
    /** 
     * Basic email rules for validation
     */
    protected $emailValidationRules = [
        "required",
        'required',
        'string',
        'email',
        'max:255',
    ];

    /**
     * Enhance with unique constraint on user email column
     */
    protected function emailValidationRulesForUser()
    {
        return [...$this->emailValidationRules, Rule::unique(User::class)];
    }
}
