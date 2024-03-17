<?php

namespace App\Http\Controllers;

use App\Actions\Authentication\CreateToken;
use App\Actions\Authentication\RegisterUser;
use App\Models\User;
use App\Traits\Validation\EmailValidationRules;
use App\Traits\Validation\HandleValidatorFailure;
use App\Traits\Validation\PasswordValidationRules;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    use EmailValidationRules;
    use PasswordValidationRules;
    use HandleValidatorFailure;

    public function login(Request $request, CreateToken $createToken): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        $failure = $this->handleValidatorFailure($validator);
        if ($failure instanceof JsonResponse) return $failure;

        $attempt = Auth::attempt($request->only('email', 'password'));

        if (!$attempt) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        // Since user is now authenticatable, grab it to create the access_token
        $user = User::where('email', $request->email)->first();

        // Use an action to encapsulate token creation logic
        $tokenData = $createToken->handle($user);

        return response()->json($tokenData);
    }

    public function register(Request $request, RegisterUser $registerUser): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:1'],
            'email' => $this->emailValidationRulesForUser(),
            'password' => $this->passwordValidationsRules
        ]);

        $failure = $this->handleValidatorFailure($validator);
        if ($failure instanceof JsonResponse) return $failure;

        $user = $registerUser->handle($request->only('name', 'email', 'password'));

        return response()->json($user);
    }
}
