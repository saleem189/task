<?php

namespace App\Enums;

enum RequestStatusEnum: string
{
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Withdrawn = 'withdrawn';
    case Pending = 'pending';

    /**
     * Get all the enum values as an array.
     *
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::Approved,
            self::Rejected,
            self::Withdrawn,
            self::Pending,
        ];
    }
}