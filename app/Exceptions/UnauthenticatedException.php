<?php


namespace App\Exceptions;

class UnauthenticatedException extends CustomBaseException{
    public function __construct(){
        parent::__construct(ExceptionsMap::UNAUTHENTICATED);

    }
}