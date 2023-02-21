<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Services\SecurityHelper;
use App\Http\Controllers\Controller;

class ApiSecurityController extends Controller
{
    private SecurityHelper $security;

    public function __construct(SecurityHelper $security)
    {
        $this->security = $security;
    }
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        return $this->security->makeAuthentication($request);
    }
    public function logout()
    {
        return $this->security->logingOut();
    }

    /**
     * add new User
     *
     * @param  mixed $request
     * @return void
     */
    public function addUser(Request $request)
    {
        return $this->security->signup($request);
    }
}
