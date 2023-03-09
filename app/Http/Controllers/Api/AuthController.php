<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthController extends Controller
{
    /**
     * User authorization
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validateFields = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);


        try {
            $user = User::where('email', $validateFields['email'])->firstOrFail();

            if (!Hash::check($validateFields['password'], $user['password'])) {
                return response(['errors' => ['password' => 'Пароли не совпадают']], 400);
            }
        } catch (Throwable $e) {
            return response(['errors' => ['email' => 'Пользователя с таким Email нет']], 400);
        }

        return response([], 200);
    }


    /**
     * User authorization
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function me(Request $request): array
    {
        return $request->user()->only(['email']);
    }
}
