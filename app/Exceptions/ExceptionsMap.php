<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

enum ExceptionsMap: int
{
    public const DEFAULT_ERROR_KEY = 0;


    case UNAUTHENTICATED = 200003;

    private const ERRORS_MAP = [
        [
            'code' => self::UNAUTHENTICATED,
            'message' => 'User not Authenticated',
            'http_status_code' => Response::HTTP_UNAUTHORIZED,
        ],
    ];

    public static function getErrorFromCode(self $code): array
    {
        foreach (self::ERRORS_MAP as $error) {
            if ($error['code'] === $code) {
                return $error;
            }
        }

        return self::ERRORS_MAP[self::DEFAULT_ERROR_KEY];
    }
}
