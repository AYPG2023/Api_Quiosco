<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistroRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(LoginRequest $request)
    {
        // Validar los datos
        $data = $request->validated();

        // Revisar la contraseña.
        if (!Auth::attempt($data)) {
            return response()->json([
                'errors' => ['Credenciales incorrectas']
            ], 422);
        }

        // Obtener el usuario autenticado.
        $user = Auth::user();
        return [
            'message' => 'Usuario autenticado correctamente',
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];
    } // Controlador para el inicio de sesion.

    public function register(RegistroRequest $request): JsonResponse
    {
        // Validar los datos
        $data = $request->validated();

        // Crear el usuario
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return response()->json([
            'message' => 'Usuario registrado correctamente',
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ], 201);
    }
    // Controlador para el registro de usuarios

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return [
            'user' => null,
        ];
    } //Controlador para cerrar sesion  
}
