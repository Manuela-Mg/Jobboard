<?php

namespace App\Http\Controllers\Api\User;

use Inertia\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AccountManager;

class AccountManagementController extends Controller
{
    private AccountManager $manager;
    public function __construct(AccountManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Update the user's profile.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateUser(Request $request)
    {
        return $this->manager->updateUserInfo($request);
    }
    /**
     * get User Details
     *
     * @return void
     */
    public function getUserDetails(Request $request)
    {
        return $this->manager->showUserInfo();
    }
    /**
     * delete Authenticated User
     *
     * @return void
     */
    public function deleteAuthUser()
    {
        return $this->manager->deleteCurrentUser();
    }
}
