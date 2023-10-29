<?php

namespace App\Services;

use App\Enums\RequestStatusEnum;
use App\Exceptions\UnauthenticatedException;
use App\Http\Resources\CommonConnectionResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class CommonConnectionService{
    public function __construct()
    {
        //
    }

    /**
     * Retrieves the connections for the authenticated user.
     *
     * @throws ModelNotFoundException if the authenticated user cannot be found
     * @return \Illuminate\Http\Resources\Json\ResourceCollection a collection of CommonConnectionResource objects representing the connections
     */
    public function getConnections(){
        $user = User::findOrFail($this->getAuthUser()->id);
        $list= $user->getInvitedUsers()->where('status', RequestStatusEnum::Approved)->get();
        return CommonConnectionResource::collection($list);
    }

    
    /**
     * Retrieves the common connections for the authenticated user.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException if the user is not found
     * @return \Illuminate\Database\Eloquent\Collection the common connections for the authenticated user
     */
    public function getCommonConnection()
    {
        $user = User::findOrFail($this->getAuthUser()->id);
        return CommonConnectionResource::collection($user->commonConnections);
    }

    public function getAuthUser(){
        if(Auth::check()){
            return auth()->user();
        }else{
            throw new UnauthenticatedException();
        }
    }
}