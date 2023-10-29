<?php

namespace App\Http\Requests;

use App\Enums\RequestStatusEnum;
use Illuminate\Validation\Rules\Enum;

class SentRequestsRequest extends CustomBaseRequest
{
    public function store(): array
    {
        return [
            'id' => 'uuid|exists:users,id',
        ];
    }


    public function update(): array
    {
        return [
            'id' => 'uuid|exists:requests,id',
            'status' => ['string',new Enum(RequestStatusEnum::class) ],
        ];
    }
}
