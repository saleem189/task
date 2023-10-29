<?php

namespace App\Models;

use App\Enums\RequestStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requests extends Model
{
    use HasFactory, HasUuids, SoftDeletes;


    protected $fillable = ['sender_id', 'receiver_id', 'status'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => RequestStatusEnum::class,
    ];

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid7();
    }

    public function getSender(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function getReciever(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function commonConnections()
    {
        return $this->belongsToMany(User::class, 'requests', 'receiver_id', 'sender_id')
            ->where('status', 'approved');
    }
}
