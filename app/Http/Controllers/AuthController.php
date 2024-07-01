<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
            'token' => $user->createToken('API token for '. $user->email,
                ['*'],
                now()->addMonth())->plainTextToken
        ];

        return $this->ok('Logged in successfully', $data);

    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return $this->ok('Logged out');
    }

}
