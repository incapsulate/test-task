<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
            ]);
        } catch (\Throwable $exception) {
            return response()->json([
                'status' => 'error',
                'error'  => 'Invalid data',
            ], 400);
        }

        auth()->login($user);

        return response()
            ->json([
                'status' => 'success',
            ])
            ->header('Authorization', auth()->user()->createToken('user')->accessToken);
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (!auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'status' => 'error',
                'error'  => 'Invalid credentials',
            ], 401);
        }

        return response()
            ->json([
                'status' => 'success',
            ])
            ->header('Authorization', auth()->user()->createToken('user')->accessToken);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->user()->token()->revoke();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
