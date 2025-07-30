<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserApprovalController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Display a listing of pending users
     */
    public function index()
    {
        // Ensure user is approved
        if (!Auth::user()->isApproved()) {
            abort(403, 'Unauthorized access');
        }

        try {
            // Get pending users directly
            $users = User::where('approval_status', 'pending')
                         ->orderBy('created_at', 'desc')
                         ->get()
                         ->toArray();
                         
            // Temporary debug - comment out after fixing
            dd($users);
            
            return view('cms.user-approval.index', [
                'users' => $users
            ]);
        } catch (\Exception $e) {
            // Log error for debugging
            \Log::error('User Approval Index Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            // Show error message to user for debugging
            return response()->view('cms.user-approval.index', [
                'users' => [],
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Approve a user
     */
    public function approve(Request $request, $userId)
    {
        // Ensure user is approved
        if (!Auth::user()->isApproved()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        try {
            $adminId = Auth::id();
            $response = $this->authService->approveUser($userId, $adminId);
            
            return response()->json([
                'success' => true,
                'message' => 'User berhasil disetujui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reject a user
     */
    public function reject(Request $request, $userId)
    {
        // Ensure user is approved
        if (!Auth::user()->isApproved()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        $request->validate([
            'reason' => 'nullable|string|max:500'
        ]);

        try {
            $adminId = Auth::id();
            $reason = $request->input('reason');
            $response = $this->authService->rejectUser($userId, $adminId, $reason);
            
            return response()->json([
                'success' => true,
                'message' => 'User berhasil ditolak'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
