<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
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

        if (!$user || !password_verify($request->password, $user->password)) {
            return $this->error('Invalid credentials');
        }

        Auth::login($user);

        return response()->json([
            "success" => true,
            "message" => 'Login berhasil',
            'data' => new UserResource($user),
        ]);
    }

    public function register(Request $request)
    {
        $user = $this->authRepository->register($request);

        return $this->success(new UserResource($user), 'Data ditemukan');
    }

    public function logout(Request $request)
    {
        if (!Auth::check()) {
            return $this->error('Unauthorized');
        }

        Auth::logout();

        // Hapus session
        //$request->session()->invalidate();
        //$request->session()->regenerateToken();

        return $this->success([], 'Logout berhasil');
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
