<?php


namespace RoistatParser\Parsers;


use RoistatParser\Exceptions\Parsers\LogFileParserException;
use RoistatParser\Model\AccessLogItem;

/**
 * Class LogFileParser Класс парсинга .log файла.
 * @package RoistatParser\Parsers
 */
class LogFileParser extends AbstractParser
{

    /**
     * Регулярное выражение, для конвертации строки access_log'a вебсервера.
     */
    const PATTERN = "/(\S+) (\S+) (\S+) \[([^:]+):(\d+:\d+:\d+) ([^\]]+)\] \"(\S+) (.*?) (\S+)\" (\S+) (\S+) (\".*?\") (\".*?\")/";

    /**
     * @param array $data Массив конвертированных данных, для конвертации в упрощённую модель
     * @return AccessLogItem Возвращает упрощённую модель.
     * @see LogFileParser::_convertToArray()
     */
    protected function _convertToLogItem(array $data): AccessLogItem
    {
        $accessLogItem = new AccessLogItem();

        $accessLogItem->setIp($data[1]);
        $accessLogItem->setIdentity($data[2]);
        $accessLogItem->setUser($data[3]);
        $accessLogItem->setDate($data[4]);
        $accessLogItem->setTime($data[5]);
        $accessLogItem->setTimezone($data[6]);
        $accessLogItem->setMethod($data[7]);
        $accessLogItem->setPath($data[8]);
        $accessLogItem->setProtocol($data[9]);
        $accessLogItem->setStatusCode($data[10]);
        $accessLogItem->setTraffic($data[11]);
        $accessLogItem->setUrl($data[12]);
        $accessLogItem->setAgent($data[13]);

        return $accessLogItem;
    }


    /**
     * @param string $raw строка access_log файла.
     * @return array возвращает массив спарсенных данных.
     * @throws LogFileParserException Если неудаётся преобразовать строку access_log файла в массив данных, то выбрасывает LogFileParserException
     * @see LogFileParser::_convertToLogItem()
     */
    protected function _convertToArray($raw): array
    {
        preg_match (self::PATTERN, $raw, $result);
        if (empty($result)) throw new LogFileParserException('Неправильный формат строки access_log файла', $raw, 5);
        return $result;
    }
}