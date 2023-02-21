<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\SecurityHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountManager
{
    private SecurityHelper $security;

    public function __construct(SecurityHelper $security)
    {
        $this->security = $security;
    }

    /**
     * updateUserInfo
     *
     * @param  mixed $request
     * @return void
     */
    public function updateUserInfo(Request $request)
    {
        if (!Auth::user()) {
            return response()->json([
                "message" => "You must be logged in to update your information"
            ], 401);
        } else {
            $user = User::find(Auth::id());
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
                Auth::logout();
            }
            if ($request->password) {
                $user->password = Hash::make($request->password);
                Auth::logout();
            }
            $user->save();
            return response()->json([
                "message" => "success"
            ], 200);
        }
    }
    /**
     * show User Info
     *
     * @return void
     */
    public function showUserInfo()
    {
        if (!Auth::user()) {
            return response()->json([
                "message" => "You must be logged in to see your information"
            ], 401);
        } else {
            $user = User::find(Auth::id());
            return response()->json([
                "user" => $user,
                "message" => "success"
            ], 200);
        }
    }
    /**
     * delete Current authenticated User
     *
     * @return void
     */
    public function deleteCurrentUser()
    {
        if (!Auth::user()) {
            return response()->json([
                "message" => "You must be logged in to delete your account"
            ], 401);
        } else {
            $user = User::find(Auth::id());
            Auth::logout();
            if ($user->delete()) {
                return response()->json([
                    "message" => "success"
                ], 200);
            }
            return response()->json([
                "message" => "an error occured"
            ], 406);
        }
    }
}
