<?php


namespace RoistatParser\Exceptions;


use Exception;

/**
 * Class AbstractParserException Exception класс для генерации ошибок связанных с парсингом.
 * @package RoistatParser\Exceptions
 */
abstract class AbstractParserException extends Exception
{
    /**
     * @type string $_raw Строка на которой не сработал алгоритм парсинга.
     */
    private $_raw;

    /**
     * AbstractParserException constructor.
     * @param string $message
     * @param string $raw
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(?string $message, ?string $raw, $code = 0, Exception $previous = null) {
        $this->_raw = $raw;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return mixed Преобразование ошибки в строку
     */
    public function toString()
    {
        return $this->_toString($this->_raw);
    }

    /**
     * @param string $raw
     * @return mixed
     */
    abstract protected function _toString(?string $raw);
}