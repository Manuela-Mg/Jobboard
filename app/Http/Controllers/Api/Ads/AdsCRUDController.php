<?php

namespace App\Http\Controllers\Api\Ads;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\Company;
use App\Services\SecurityHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdsCRUDController extends Controller
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
        $ads = Advertisement::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Advertisement list',
            'advertisement' => $ads
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
            $com = Company::find($request->com_id);
            if (!$com) {
                return response()->json([
                    "message" => "company not found"
                ], 404);
            }
            $ads = new Advertisement;
            $ads->title = $request->title;
            $ads->description = $request->description;
            $ads->wages = $request->wages;
            $ads->location = $request->location;
            $ads->workTime = $request->workTime;
            $ads->company()->associate($com);
            $ads->save();
            $response = response()->json([
                "message" => "advertisement created successfully",
                'advertisement' => $ads
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
            $ads = Advertisement::find($request->id);
            if (!$ads) {
                return response()->json([
                    "message" => self::NOT_FOUND
                ], 404);
            }

            $response = response()->json([
                'Advertisement' => $ads,
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
            $ads = Advertisement::find($request->id);
            if (!$ads) {
                return response()->json([
                    "message" => self::NOT_FOUND
                ], 404);
            }
            ($request->title) ? $ads->title = $request->title : $ads->title;
            ($request->description) ? $ads->description = $request->description : $ads->description;
            ($request->wages) ? $ads->wages = $request->wages : $ads->wages;
            ($request->location) ? $ads->location = $request->location : $ads->location;
            ($request->workTime) ? $ads->workTime = $request->workTime : $ads->workTime;
            $ads->save();
            $response = response()->json([
                "message" => "success",
                'Advertisement' => $ads
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
            $ads = Advertisement::find($request->id);
            if (!$ads) {
                return response()->json([
                    "message" => self::NOT_FOUND
                ], 404);
            }
            $ads->delete();

            $response = response()->json([
                "message" => "success"
            ], 200);
        }
        return $response;
    }
}
