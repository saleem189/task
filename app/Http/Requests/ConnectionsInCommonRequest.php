<?php

namespace App\Http\Requests;

use App\Enums\RequestStatusEnum;
use Illuminate\Validation\Rules\Enum;

class ConnectionsInCommonRequest extends CustomBaseRequest
{
    public function store(): array
    {
        return [
            'id' => 'uuid|exists:users,id',
        ];
    }


    public function destory(): array
    {
        return [
            'id' => 'uuid|exists:requests,id',
        ];
    }
}
