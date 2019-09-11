<?php


namespace RoistatParser\Exceptions;


use Exception;

class LogFileParserException extends Exception
{
    private $_raw;

    public function __construct(?string $message, $code = 0, ?string $raw, Exception $previous = null) {
        $this->_raw = $raw;
        parent::__construct($message, $code, $previous);
    }

    // Переопределим строковое представление объекта.
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\nRAW - {$this->_raw}";
    }
}