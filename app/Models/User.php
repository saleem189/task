<?php

namespace App\Models;

use App\Enums\RequestStatusEnum;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function newUniqueId(): string
    {
        return (string) Uuid::uuid7();
    }

    public function sentUserInvite(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Requests::class, 'sender_id');
    }
    public function getInvitedUsers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Requests::class, 'sender_id');
    }

    public function getRecievedRequests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Requests::class, 'reciever_id');
    }

    public function getConnctions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ConnectionsInCommon::class, 'user_id');
    }
    
    public function scopeUnconnectedUsers($query, $userId)
    {
        return $query->whereNotIn('id', function ($query) use ($userId) {
            $query->select('receiver_id')
                ->from('requests')
                ->where('sender_id', $userId)
                ->whereIn('status', [RequestStatusEnum::Withdrawn, RequestStatusEnum::Rejected])
                ->orWhereNotExists(function ($query) use ($userId) {
                    $query->select('id')
                        ->from('requests')
                        ->where('sender_id', $userId);
                });
        })->whereNotIn('id', function ($query) use ($userId) {
            $query->select('sender_id')
                ->from('requests')
                ->where('receiver_id', $userId)
                ->whereIn('status', [RequestStatusEnum::Withdrawn, RequestStatusEnum::Rejected])
                ->orWhereNotExists(function ($query) use ($userId) {
                    $query->select('id')
                        ->from('requests')
                        ->where('receiver_id', $userId);
                });
        })->where('id', '!=', $userId);
    }


    public function commonConnections()
    {
        return $this->belongsToMany(User::class, 'requests', 'sender_id', 'receiver_id')
            ->where('status', 'approved');
    }
}
