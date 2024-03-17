<?php

namespace App\Actions\Authentication;

use App\Models\User;

class CreateToken
{
    /**
     * Create and return token data for given user
     */
    public function handle(User $user)
    {
        $token =  $user->createToken('auth_token');
        return [
            'access_token' => $token->plainTextToken,
            'token_type' => "Bearer",
        ];
    }
}
