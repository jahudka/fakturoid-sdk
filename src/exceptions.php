<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK;


class Exception extends \Exception { }

class MemberAccessException extends Exception { }

class ReadonlyEndpointException extends Exception { }

class ReadonlyEntityException extends Exception {
    public function __construct(
        string $message = 'Cannot modify read-only entity',
        int $code = 0,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}

class ReadonlyPropertyException extends Exception {
    public function __construct(
        string $message = 'Cannot modify read-only property',
        int $code = 0,
        \Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
