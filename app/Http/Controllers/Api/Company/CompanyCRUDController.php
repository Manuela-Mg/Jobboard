<?php

namespace App\Http\Controllers\Api\Company;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Services\SecurityHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompanyCRUDController extends Controller
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
        $com = Company::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Company list',
            'Company' => $com
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
            $user = User::find($request->user_id);
            if (!$user) {
                return response()->json([
                    "message" => "user not found"
                ], 404);
            }
            $com = new Company;
            $com->name = $request->name;
            $com->intro = $request->intro;
            $com->address = $request->address;
            $com->phone = $request->phone;
            $com->email = $request->email;
            $com->webSite = $request->webSite;
            $com->user()->associate($user);
            $com->save();
            $response = response()->json([
                "message" => "application done successfully",
                'company' => $com
            ], 201);
        }
        return $response;
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
            $com = Company::find($request->id);
            if (!$com) {
                return response()->json([
                    "message" => self::NOT_FOUND
                ], 404);
            }

            $response = response()->json([
                'Company' => $com,
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
            $com = Company::find($request->id);
            if (!$com) {
                return response()->json([
                    "message" => self::NOT_FOUND
                ], 404);
            }
            if ($request->user_id) {
                $user = User::find($request->user_id);
                if (!$user) {
                    return response()->json([
                        "message" => "user not found"
                    ], 404);
                }
                $com->user()->associate($user);
            }
            ($request->name) ? $com->name = $request->name : $com->name;
            ($request->intro) ? $com->intro = $request->intro : $com->intro;
            ($request->address) ? $com->address = $request->address : $com->address;
            ($request->phone) ? $com->phone = $request->phone : $com->phone;
            ($request->email) ? $com->email = $request->email : $com->email;
            ($request->webSite) ? $com->webSite = $request->webSite : $com->webSite;
            $com->save();
            $response = response()->json([
                "message" => "success",
                'Company' => $com
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
            $com = Company::find($request->id);
            if (!$com) {
                return response()->json([
                    "message" => self::NOT_FOUND
                ], 404);
            }
            $com->delete();

            $response = response()->json([
                "message" => "success"
            ], 200);
        }
        return $response;
    }
}
