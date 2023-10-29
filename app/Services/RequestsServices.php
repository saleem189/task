<?php

namespace App\Services;

use App\Enums\RequestStatusEnum;
use App\Exceptions\UnauthenticatedException;
use App\Http\Resources\RequestResource;
use App\Http\Resources\SentRequestResource;
use App\Models\Requests;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class RequestsServices
{
    /**
     * Retrieves the list of sent requests for the authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection The list of sent requests.
     */
    public function getSentRequests(){

        $authUser = $this->getAunthaticatedUser();
        $sentRequestList = Requests::where('sender_id', $authUser->id)->where('status', RequestStatusEnum::Pending)->get();
        return RequestResource::collection($sentRequestList);
    }

    /**
     * Retrieves the list of received requests for the authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection The list of received requests.
     */
    public function getRecievedRequests(){
        $authUser = $this->getAunthaticatedUser();
        $recievedRequestList = Requests::where('receiver_id', $authUser->id)->where('status', RequestStatusEnum::Pending)->get();
        return RequestResource::collection($recievedRequestList);
    }

    public function inviteUser(User $user){
        $authUser = $this->getAunthaticatedUser();

        return $authUser->sentUserInvite()->create([
            'receiver_id' => $user->id
        ]);
    }

    public function updateRequest($status, Requests $request){
        
        $authUser = $this->getAunthaticatedUser();
        $request->update([
            'status' => $status
        ]);
        return $request->fresh();
    }



    public function getAunthaticatedUser(){
        if (Auth::check()) {
            return Auth::user();
        } else {
            throw new UnauthenticatedException();
        }
    }
}