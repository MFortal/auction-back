<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * User Registration
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validateFields = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        // Если пользователь с таким Email уже есть
        if (User::where('email', $validateFields['email'])->exists()) {
            return response(['errors' => ['email' => 'Пользователь с таким Email уже существует']], 400);
        }

        $user = User::create($validateFields);

        if ($user) {
            $token = $user->createToken('api')->plainTextToken;
            return response(['token' => $token], 200);
        }

        return response(['errors' => ['email' => 'Не удалось зарегистрировать пользователя']], 400);
    }
}
