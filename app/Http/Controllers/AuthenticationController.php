<?php

namespace App\Http\Controllers;

use App\Actions\Authentication\CreateToken;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login(Request $request, CreateToken $createToken): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }


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
}
