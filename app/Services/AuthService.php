<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\AuthRepositoryInterface;

class AuthService
{
    use ApiResponse;

    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(Request $request)
    {
        $user = $this->authRepository->findByEmail($request->email);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                "success" => false,
                "message" => 'Email atau kata sandi salah',
            ], 401);
        }

        Auth::login($user);

        return response()->json([
            "success" => true,
            "message" => 'Login berhasil',
            'data' => new UserResource($user),
        ]);
    }

    public function register($data)
    {
        $user = $this->authRepository->register($data);

        Auth::login($user);

        return response()->json([
            "success" => true,
            "message" => 'Pendaftaran berhasil',
            'data' => new UserResource($user),
        ]);
    }

    public function logout(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                "success" => false,
                "message" => 'Unauthorized',
            ], 401);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            "success" => true,
            "message" => 'Logout berhasil',
        ]);
    }

    public function getUser()
    {
        if (!Auth::check()) {
            return $this->error('Unauthorized');
        }
        $user = Auth::user();
        return $this->success(new UserResource($user), 'Data ditemukan');
    }
}
