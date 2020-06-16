<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Requests\API\Auth\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function registration(RegistrationRequest $request)
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

        return response()->json([
            'status' => 'success',
            'data'   => [
                'token' => auth()->user()->createToken('user'),
            ],
        ]);
    }

    public function login(LoginRequest $request)
    {

    }
}
