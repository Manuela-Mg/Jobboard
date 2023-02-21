<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\SecurityHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserCRUDController extends Controller
{
    private SecurityHelper $security;
    const NOT_LOGGEDIN_MSG = 'You must be logged in to access this resource';
    const ADMIN_ROLE_MSG = 'You must have admin role to access this resource';
    const NOT_FOUND = 'resource not found';

    public function __construct(SecurityHelper $security)
    {
        $this->security = $security;
    }

    /**
     * index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        if (!Auth::user()) {
            return response()->json([
                'status' => 'error',
                'message' => self::NOT_LOGGEDIN_MSG
            ], 401);
        }

        if (!$this->security->hasRole('admin', $request->user())) {
            return response()->json([
                'status' => 'error',
                'message' => self::ADMIN_ROLE_MSG
            ], 401);
        }
        $users = User::all();
        return response()->json([
            'status' => 'success',
            'message' => 'User list',
            'users' => $users
        ], 200);
    }
    /**
     * add
     *
     * @param  mixed $request
     * @return void
     */
    public function add(Request $request)
    {
        if (!Auth::user()) {
            return response()->json([
                'status' => 'error',
                'message' => self::NOT_LOGGEDIN_MSG
            ], 401);
        }

        if (!$this->security->hasRole('admin', $request->user())) {
            return response()->json([
                'status' => 'error',
                'message' => self::ADMIN_ROLE_MSG
            ], 401);
        }
        return redirect('api/signup');
    }
    /**
     * show
     *
     * @param  mixed $request
     * @return void
     */
    public function show(Request $request)
    {
        if (!Auth::user()) {
            $response = response()->json([
                'status' => 'error',
                'message' => self::NOT_LOGGEDIN_MSG
            ], 401);
        } elseif (!$this->security->hasRole('admin', $request->user())) {
            $response = response()->json([
                'status' => 'error',
                'message' => self::ADMIN_ROLE_MSG
            ], 401);
        } else {
            $user = User::find($request->id);
            if (!$user) {
                return response()->json([
                    "message" => self::NOT_FOUND
                ], 404);
            }

            $response = response()->json([
                "user" => $user,
                "message" => "success"
            ], 200);
        }
        return $response;
    }
    /**
     * update
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request)
    {
        if (!Auth::user()) {
            $response = response()->json([
                'status' => 'error',
                'message' => self::NOT_LOGGEDIN_MSG
            ], 401);
        } elseif (!$this->security->hasRole('admin', $request->user())) {
            $response = response()->json([
                'status' => 'error',
                'message' => self::ADMIN_ROLE_MSG
            ], 401);
        } else {
            $user = User::find($request->id);
            if (!$user) {
                return response()->json([
                    "message" => self::NOT_FOUND
                ], 404);
            }
            if (User::where('email', '=', $request->email)->exists()) {
                return response()->json([
                    "message" => "email adress already exits."
                ], 406);
            }
            if ($request->name) {
                $user->name = $request->name;
            }
            if ($request->phone) {
                $user->phone = $request->phone;
            }
            if ($request->email) {
                $user->email = $request->email;
            }
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            $response = response()->json([
                "message" => "success",
                'user' => $user
            ], 200);
        }
        return $response;
    }
    public function delete(Request $request)
    {
        if (!Auth::user()) {
            $response = response()->json([
                'status' => 'error',
                'message' => self::NOT_LOGGEDIN_MSG
            ], 401);
        } elseif (!$this->security->hasRole('admin', $request->user())) {
            $response = response()->json([
                'status' => 'error',
                'message' => self::ADMIN_ROLE_MSG
            ], 401);
        } else {
            $user = User::find($request->id);
            if (!$user) {
                return response()->json([
                    "message" => self::NOT_FOUND
                ], 404);
            }
            $user->delete();

            $response = response()->json([
                "message" => "success"
            ], 200);
        }
        return $response;
    }
}
