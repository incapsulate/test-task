<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get()
    {
        return response()->json([
            'status' => 'success',
            'data'   => new UserResource(auth()->user()),
        ]);
    }
}
