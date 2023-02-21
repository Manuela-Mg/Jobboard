<?php

namespace App\Services;

use App\Mail\ApplicationDone;
use App\Models\User;
use App\Models\Jobapp;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JobAppHelper
{

    public function apply(Request $request)
    {
        $ads = Advertisement::where('id', '=', $request->ads_id)->first();
        if (!$ads) {
            return response()->json([
                "message" => "advertisement not found"
            ], 404);
        }
        $user = User::find(Auth::id());
        // $owner = $ads->company->user;
        $owner = User::where('email', '=', 'sybtra@gmail.com')->first();
        $subject = "New application to $ads->title";
        $jobApp = new Jobapp();
        $jobApp->message = "From: $user->email\n To: $owner->email\n date: " .
            now() . "\nSubject: $subject\nMessage: Hi, the applicant $user->name just applied to your job advertisement.";
        $jobApp->advertisement()->associate($ads);
        $jobApp->user()->associate($user);
        $jobApp->save();
        Mail::to($owner)->send(new ApplicationDone($user, $user->email, $subject, 'emails.application.done'));
        return response()->json([
            "message" => "application done successfully",
            'application' => $jobApp
        ], 201);
    }
}
