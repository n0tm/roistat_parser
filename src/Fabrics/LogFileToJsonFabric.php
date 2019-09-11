<?php


namespace RoistatParser;


use RoistatParser\OutputConverters\AbstractOutputConverter;
use RoistatParser\OutputConverters\JSONOutputConverter;
use RoistatParser\Parsers\AbstractParser;
use RoistatParser\Parsers\LogFileParser;
use RoistatParser\Readers\AbstractReader;
use RoistatParser\Readers\FileReader;
use RoistatParser\SortingMethods\AbstractSortingMethod;
use RoistatParser\SortingMethods\BasicSortingMethod;

class LogFileToJsonFabric implements Interfaces\ParserFactoryInterface
{

    private $_LogFilePath;

    /**
     * @param mixed $LogFilePath
     */
    public function setLogFilePath($LogFilePath): void
    {
        $this->_LogFilePath = $LogFilePath;
    }


    public function createReader(): AbstractReader
    {
        return new FileReader($this->_LogFilePath);
    }

    public function createParser(): AbstractParser
    {
        return new LogFileParser();
    }

    public function createSortingMethod(): AbstractSortingMethod
    {
        $basicSortingMethod = new BasicSortingMethod();

        $basicSortingMethod->addTrackingCrawler("Google");
        $basicSortingMethod->addTrackingCrawler("Bing");
        $basicSortingMethod->addTrackingCrawler("Baidu");
        $basicSortingMethod->addTrackingCrawler("Yandex");

        return $basicSortingMethod;
    }

    public function createOutputConverter(): AbstractOutputConverter
    {
        return new JSONOutputConverter();
    }
}