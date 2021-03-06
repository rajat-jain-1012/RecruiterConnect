<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelp;
use App\Http\Resources\UserConnectionResource;
use App\Http\Resources\UserResource;
use App\Models\Users;
use App\Services\ConnectionService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers() {
        $userList = Users::all();
        return ResponseHelp::success('success', UserResource::collection($userList));
    }

    public function getUserDetail(Request $request) {;
        $user = Users::find($request->id);
        return ResponseHelp::success('User Details fetched successfully', UserResource::make($user));
    }

    public function deleteUser() {
        return ResponseHelp::success();
    }

    public function changeStatus(Request $request) {
        $user = Users::where('id',$request->id)->first();
        $uerStatus = $user->status;
        $user->update(['status' => !$uerStatus]);
        return ResponseHelp::success();
    }

    public function updateUser(Request $request) {
        $user = Users::where('id',$request->id)->first();
        $user->update($request->all());
        return ResponseHelp::success();
    }

    public function showAllRequests(Request $request) {
        $userId = $request->user_id;
        $requests = ConnectionService::make()->userRequests($userId);
        return ResponseHelp::success('Success', UserConnectionResource::make($requests));
    }

}
