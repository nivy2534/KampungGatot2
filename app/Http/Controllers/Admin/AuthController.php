<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Models\User; // atau model User kamu

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @group Auth
     *
     * Login user
     * @header Cookie XSRF-TOKEN
     * @header Content-Type application/json
     * @header Accept application/json
     *
     * Endpoint ini digunakan untuk login user dan mengembalikan data user dalam bentuk json.
     *
     * @bodyParam email string required Email user. Example: admin@gmail.com
     * @bodyParam password string required Password user. Example: 123123
     *
     * @response 200 {
     *   "status": sucecss,
     *   "message": "Login berhasil"
     *   "data": {
     *        "id": 1,
     *        "name": "Admin Desa",
     *        "email": "admin@gmail.com",
     *    }
     * }
     *
     */
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            return response()->json([
                'status' => 'success',
                'message' => 'Login berhasil',
                'data' => $user,
                'redirect' => 'http://localhost:3000/dashboard',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Email atau password salah',
        ], 401);
    }

   

    public function register(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'email' => $validated['email'],
            'name' => $validated['name'],
            'password' => bcrypt($validated['password']),
        ]);

        auth()->login($user);

        return redirect()->away('http://localhost:3000/dashboard');
    }


    /**
     * @group Auth
     * Logout user
     *
     * @header Cookie XSRF-TOKEN
     * @header Content-Type application/json
     * @header Accept application/json
     *
     * Endpoint untuk logout user yang sudah login.
     *
     * @response 200 {
     *   "message": "Logout berhasil"
     * }
     */
    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }

    /**
     *
     * @group Auth
     *
     * @header Cookie XSRF-TOKEN
     * @header Content-Type application/json
     * @header Accept application/json
     *
     * Detail user
     *
     * Endpoint ini digunakan untuk mendapatkan data user yang sudah login berdasarkan session cookie yang ada.
     *
     * @params null
     *
     * @response 200 {
     *   "status": sucecss,
     *   "message": "Data berhasil ditemukan"
     *   "data": {
     *        "id":"1",
     *        "name":"Admin",
     *        "email": "admin@gmail.com",
     *    }
     * }
     *
     */
    public function user()
    {
        return $this->authService->getUser();
    }
}
