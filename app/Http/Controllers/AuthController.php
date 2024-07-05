<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use App\Permissions\V1\Abilities;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    use ApiResponses;

    /**
     *
     * Login
     *
     * Authenticates the user and returns the user's API token.
     *
     * @unauthenticated
     * @group Authentication
     * @response 200 {
     *     "data": {
     *  "user": {
     *  "id": 1,
     *  "name": "Jada Kunde II",
     *  "email": "qcrist@example.net",
     *  "email_verified_at": "2024-07-04T00:17:44.000000Z",
     *  "is_manager": 0,
     *  "created_at": "2024-07-04T00:17:44.000000Z",
     *  "updated_at": "2024-07-04T00:17:44.000000Z"
     *  },
     *  "token": "{YOUR_AUTH_KEY}"
     *  },
     *  "message": "Logged in successfully",
     *  "status": 200
     * }
     *
     */


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
                Abilities::getAbilities($user),
                now()->addMonth())->plainTextToken
        ];

        return $this->ok('Logged in successfully', $data);

    }

    public function register(RegisterRequest $request)
    {
        return $request->validated();
    }



    /**
     *
     * Logout
     *
     * Signs out the user and destroy's the API token.
     *
     * @group Authentication
     * @response 200 {}
     *
     */
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return $this->ok('Logged out');
    }

}
