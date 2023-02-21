<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Session\Session;
use Illuminate\Validation\Rules;

class SecurityHelper
{
    /**
     * authenticate user and set a session
     *
     * @param  mixed $request
     * @return void
     */
    public function makeAuthentication(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $token = Auth::attempt($request->only('email', 'password'));

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'email or password invalid',
            ], 401);
        }
        $request->session()->regenerate();
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
        ]);
    }
    /**
     * disConnect Current authenticated User
     *
     * @return void
     */
    public function logingOut()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    /**
     * signup a user
     *
     * @param  mixed $request
     * @return void
     */
    public function signup(Request $request)
    {
        if (Auth::user() && !$this->hasRole('admin', $request->user())) {
            return response()->json([
                "message" => "Unauthorized"
            ], 401);
        }

        if (User::where('email', '=', $request->email)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'email already exists',
            ], 401);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);
        $user->assignRole('user');
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
    }
    public function hasRole($roleName, User $user)
    {
        foreach (User::role($roleName)->get() as $role) {
            if ($role->id === $user->id) {
                return true;
            }
        }

        return false;
    }
}
