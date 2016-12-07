<?php


namespace Jahudka\FakturoidSDK;

class Exception extends \Exception { }

class MemberAccessException extends Exception { }

class ReadonlyEndpointException extends Exception { }

class ReadonlyEntityException extends Exception {
    public function __construct($message = 'Cannot modify read-only entity', $code = 0, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

class ReadonlyPropertyException extends Exception {
    public function __construct($message = 'Cannot modify read-only property', $code = 0, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
