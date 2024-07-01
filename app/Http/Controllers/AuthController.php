<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    use ApiResponses;
    public function login(LoginRequest $request): JsonResponse
    {
        $email = $request->validated('email');
        $password = $request->validated('password');

        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return $this->error('Invalid credentials', 401);
        }

        $user = User::Where('email', $email)->first();

        $data = [
            'user' => $user,
            'token' => $user->createToken('API token for '. $user->email)->plainTextToken
        ];

        return $this->ok('Logged in successfully', $data);

    }

}
