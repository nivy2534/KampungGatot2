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

        // Check if user is approved
        if (!$user->isApproved()) {
            $message = match($user->approval_status) {
                'pending' => 'Akun Anda masih menunggu persetujuan administrator',
                'rejected' => 'Akun Anda telah ditolak. Silakan hubungi administrator',
                default => 'Akun Anda tidak dapat mengakses sistem'
            };
            
            return response()->json([
                "success" => false,
                "message" => $message,
                "approval_status" => $user->approval_status,
            ], 403);
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

        // Don't auto-login user, they need approval first
        return response()->json([
            "success" => true,
            "message" => 'Pendaftaran berhasil! Akun Anda akan diaktifkan setelah mendapat persetujuan dari administrator.',
            'data' => new UserResource($user),
            'approval_status' => 'pending',
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

    public function approveUser($userId, $adminId)
    {
        $user = User::findOrFail($userId);
        
        $user->update([
            'approval_status' => 'approved',
            'approved_at' => now(),
            'approved_by' => $adminId,
        ]);

        return response()->json([
            "success" => true,
            "message" => 'User berhasil disetujui',
            'data' => new UserResource($user),
        ]);
    }

    public function rejectUser($userId, $adminId, $reason = null)
    {
        $user = User::findOrFail($userId);
        
        $user->update([
            'approval_status' => 'rejected',
            'approved_by' => $adminId,
            'rejection_reason' => $reason,
        ]);

        return response()->json([
            "success" => true,
            "message" => 'User berhasil ditolak',
            'data' => new UserResource($user),
        ]);
    }

    public function getPendingUsers()
    {
        $users = User::where('approval_status', 'pending')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return response()->json([
            "success" => true,
            "message" => 'Data ditemukan',
            'data' => $users->toArray(), // Use toArray() instead of UserResource
        ]);
    }
}
