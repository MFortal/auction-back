<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PrivateEntrepreneur;
use App\Models\User;
use Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validateFields = $request->validate([
            'email' => 'required|email:dns|unique:users,email|max:255',
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

    public function registerPrivate(Request $request)
    {
        $validateFields = $request->validate([
            'email' => 'required|email:dns|max:255',
            'password' => 'required',
            'organization_name' => 'required'
        ]);

        // Если пользователь с таким Email уже есть
        if (User::where('email', $validateFields['email'])->exists()) {
            return response(['errors' => ['email' => 'Пользователь с таким Email уже существует']], 400);
        }

        $user = DB::transaction(function () use ($validateFields) {
            $newUser = User::create([
                'email' => $validateFields['email'],
                'password' => $validateFields['password'],
                'role' => Common::$roles['private'],
            ]);

            PrivateEntrepreneur::create([
                'email' => $validateFields['email'],
                'organization_name' => $validateFields['organization_name'],
            ]);

            return $newUser;
        });

        if ($user) {
            $token = $user->createToken('api')->plainTextToken;
            return response(['token' => $token], 200);
        }

        return response(['errors' => ['email' => 'Не удалось зарегистрировать пользователя']], 400);
    }
}
