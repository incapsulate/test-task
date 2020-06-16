<?php

namespace App\Http\Requests\API\Auth;

use App\Http\Requests\Request;

class LoginRequest extends Request
{
    public function rules()
    {
        return [
            'email'    => 'required',
            'password' => 'required',
        ];
    }
}
