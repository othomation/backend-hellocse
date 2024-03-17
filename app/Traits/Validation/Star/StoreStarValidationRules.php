<?php

namespace App\Traits\Validation\Star;

use Illuminate\Validation\Rules\File;

trait StoreStarValidationRules
{
    protected function storeStarValidationsRules()
    {
        return [

            'firstname' => ['required', 'min:2', 'max:50'],
            'lastname' => ['required', 'min:2', 'max:50'],
            'description' => ['required', 'min:1', 'array'],
            'image' => [
                'required',
                File::image()->max(2 * 1024)
            ]

        ];
    }
}
