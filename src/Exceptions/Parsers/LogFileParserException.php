<?php


namespace RoistatParser\Exceptions\Parsers;

use Exception;
use RoistatParser\Exceptions\AbstractParserException;

/**
 * Class LogFileParserException Exception который срабатывает при ошибки парсинга .log файла
 * @package RoistatParser\Exceptions\Parsers
 */
class LogFileParserException extends AbstractParserException
{

    /**
     * LogFileParserException constructor.
     * @param string $message
     * @param string $raw
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(?string $message, ?string $raw, $code = 0, Exception $previous = null) {
        parent::__construct($message, $raw, $code, $previous);
    }

    /**
     * Метод конвертирует ошибку в строку.
     * @param string|null $raw
     * @return mixed|string
     */
    protected function _toString(?string $raw)
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\nRAW - {$raw}";
    }
}