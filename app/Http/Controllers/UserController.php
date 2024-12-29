<?php

namespace App\Http\Controllers;

use App\Actions\User\RegisterUser;
use App\Events\UserRegistered;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(RegisterUserRequest $request, RegisterUser $registerUser): JsonResponse
    {
        $validated = $request->validated();

        $user = $registerUser->execute($validated);

        $token = $user->createToken('auth_token')->plainTextToken;

        event(new UserRegistered($user));

        return response()->json([
            "status" => true,
            'access_token' => $token,
            "data" => $user->load('company'),
        ]);
    }
    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', '=', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'status' => 0,
                'message' => 'Credenciales incorrectas.',
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => '¡Usuario autenticado exitosamente!',
            'access_token' => $token,
            'user' => $user
        ]);
    }

    public function userProfile(): JsonResponse
    {
        return response()->json([
            "status" => true,
            "user" => auth()->user(),
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user) {
            $user->tokens()->delete();

            return response()->json([
                "status" => true,
                "message" => "La sesión fue cerrada exitosamente"
            ]);
        }

        return response()->json([
            "status" => false,
            "message" => "No se pudo cerrar sesión, el usuario no está autenticado."
        ], 401);
    }
}
