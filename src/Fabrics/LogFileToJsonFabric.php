<?php


namespace RoistatParser\Fabrics;


use RoistatParser\OutputConverters;
use RoistatParser\Parsers;
use RoistatParser\Readers;
use RoistatParser\SortingMethods;

/**
 * Class LogFileToJsonFabric Фабрика для генерации компонентов для чтения .log файла.
 * @package RoistatParser
 */
class LogFileToJsonFabric extends AbstractParserFabric
{

    /**
     * @type string $_logFilePath Путь до .log файла, который нужно спарсить.
     */
    private $_logFilePath;

    /**
     * @param string $logFilePath
     */
    public function setLogFilePath(?string $logFilePath): void
    {
        $this->_logFilePath = $logFilePath;
    }


    /**
     * @return Readers\AbstractReader
     */
    protected function _createReader(): Readers\AbstractReader
    {
        return new Readers\FileReader($this->_logFilePath);
    }

    /**
     * @return Parsers\AbstractParser
     */
    protected function _createParser(): Parsers\AbstractParser
    {
        return new Parsers\LogFileParser();
    }

    /**
     * @return SortingMethods\AbstractSortingMethod
     */
    protected function _createSoringMethod(): SortingMethods\AbstractSortingMethod
    {
        return new SortingMethods\BasicSortingMethod();
    }

    /**
     * @return OutputConverters\AbstractOutputConverter
     */
    protected function _createOutputConverter(): OutputConverters\AbstractOutputConverter
    {
        return new OutputConverters\JSONOutputConverter();
    }
}