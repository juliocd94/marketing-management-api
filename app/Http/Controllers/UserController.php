<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'companyName' => 'required|string',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        do {
            $uniqueCode = Str::random(6);
        } while (Company::where('code', $uniqueCode)->exists());

        $company = new Company();
        $company->plan_id = 1;
        $company->name = $validated['companyName'];
        $company->code = $uniqueCode;
        $company->save();

        $user = new User();
        $user->company_id = $company->id;
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "status" => true,
            "message" => "Usuario creado exitosamente",
            'access_token' => $token,
            "data" => $user->load('company')
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
