<?php

namespace App\Http\Controllers\Api\JobApp;

use App\Models\User;
use App\Models\Jobapp;
use Illuminate\Http\Request;
use App\Mail\ApplicationDone;
use App\Models\Advertisement;
use App\Services\JobAppHelper;
use App\Services\SecurityHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JobAppCRUDController extends Controller
{
    private JobAppHelper $helper;
    private SecurityHelper $security;
    const NOT_LOGGEDIN_MSG = 'You must be logged in to access this resource';
    const ADMIN_ROLE_MSG = 'You must have admin role to access this resource';
    const NOT_FOUND = 'resource not found';

    public function __construct(JobAppHelper $helper, SecurityHelper $security)
    {
        $this->helper = $helper;
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
        $jobapps = Jobapp::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Job application list',
            'jobapps' => $jobapps
        ], 200);
    }

    /**
     * addJobApplication
     *
     * @param  mixed $request
     * @return void
     */
    public function addJobApplication(Request $request)
    {
        if (!Auth::user()) {
            return response()->json([
                "message" => "You must be logged in to apply to a job"
            ], 401);
        }
        return $this->helper->apply($request);
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
            $ads = Advertisement::find($request->ads_id);
            if (!$user || !$ads) {
                return response()->json([
                    "message" => "user or advertisement not found"
                ], 404);
            }
            $owner = $ads->company->user;
            $subject = "New application to $ads->title";
            $jobApp = new Jobapp();
            $jobApp->message = "From: $user->email\nTo: $owner->email\ndate: " .
            now() . "\nSubject: $subject\nMessage: Hi, the applicant $user->name just applied to your job advertisement.";
            $jobApp->advertisement()->associate($ads);
            $jobApp->user()->associate($user);
            $jobApp->save();
            Mail::to($owner)->send(new ApplicationDone($user, $user->email, $subject, 'emails.application.done'));
            $response = response()->json([
                "message" => "application done successfully",
                'application' => $jobApp
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
            $jobapp = Jobapp::find($request->id);
            if (!$jobapp) {
                return response()->json([
                    "message" => self::NOT_FOUND
                ], 404);
            }

            $response = response()->json([
                "jobapp" => $jobapp,
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
            $jobapp = Jobapp::find($request->id);
            if (!$jobapp) {
                return response()->json([
                    "message" => self::NOT_FOUND
                ], 404);
            }
            if ($request->message) {
                $jobapp->message = $request->message;
            }
            $jobapp->save();
            $response = response()->json([
                "message" => "success",
                'jobapp' => $jobapp
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
            $jobapp = Jobapp::find($request->id);
            if (!$jobapp) {
                return response()->json([
                    "message" => self::NOT_FOUND
                ], 404);
            }
            $jobapp->delete();

            $response = response()->json([
                "message" => "success"
            ], 200);
        }
        return $response;
    }
}
