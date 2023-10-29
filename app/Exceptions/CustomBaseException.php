<?php

namespace App\Exceptions;

abstract class CustomBaseException extends \Exception
{
    private string $codeStr;
    private int $httpStatusCode;

    public function __construct(ExceptionsMap $code, private readonly string $reason = '')
    {
        $this->code = $code;

        $error = ExceptionsMap::getErrorFromCode($this->code);

        $this->codeStr = $this->code->name;
        $this->message = $error['message'];
        $this->httpStatusCode = $error['http_status_code'];

        parent::__construct($this->getFullMessage(), $code->value);
    }

    public function getFullMessage(): string
    {
        $reason = $this->reason ? ". $this->reason " : '';

        return "$this->message$reason";
    }

    public function getCodeStr(): string
    {
        return $this->codeStr;
    }

    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }
}