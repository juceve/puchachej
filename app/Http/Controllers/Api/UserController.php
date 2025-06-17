<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ApiResponse;

class UserController extends Controller
{
    public function login(Request $request)
    {
        // Valida las credenciales que recibimos del usuario
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Verifica si las credenciales son correctas
        if (!Auth::attempt($credentials)) {
            return ApiResponse::error('Invalid credentials', 401);
        }

        // Si el login es exitoso, obtenemos al usuario autenticado
        $user = Auth::user();

        // Creamos un token para la API
        $token = $user->createToken('api_token')->plainTextToken;

        // Respondemos con el usuario y el token
        return ApiResponse::success([
            'user' => $user,
            'token' => $token,
        ], 'Login successful');
    }

    public function logout(Request $request)
    {
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        return ApiResponse::success([], 'Logout successful');
    }
}
