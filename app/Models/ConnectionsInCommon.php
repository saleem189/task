<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class ConnectionsInCommon extends Model
{
    use HasFactory, HasUuids;


    public function newUniqueId(): string
    {
        return (string) Uuid::uuid7();
    }
}
