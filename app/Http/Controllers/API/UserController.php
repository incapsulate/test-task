<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get(User $user)
    {
        return response()->json([
            'status' => 'success',
            'data'   => $user->toJson(),
        ]);
    }
}
