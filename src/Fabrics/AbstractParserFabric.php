<?php


namespace RoistatParser\Fabrics;


use RoistatParser\OutputConverters\AbstractOutputConverter;
use RoistatParser\Parser;
use RoistatParser\Parsers\AbstractParser;
use RoistatParser\Readers\AbstractReader;
use RoistatParser\SortingMethods\AbstractSortingMethod;

/**
 * Class AbstractParserFabric Фабрика для корректной работы парсера. Пока интегрирована только поддержка чтения, парсинга, сортировки базовым методом и выводом в JSON строку.
 * @see https://gist.github.com/flrnull/7304afeb9e8a1f4faec3#file-script
 * @package RoistatParser\Fabrics
 */
abstract class AbstractParserFabric
{

    /**
     * @var AbstractReader Класс для чтения содержимого
     */
    private $_reader;
    /**
     * @var AbstractParser Класс для парсинга содержимого
     */
    private $_parser;
    /**
     * @var AbstractSortingMethod Класс для сортировки содержимого
     */
    private $_soringMethod;
    /**
     * @var AbstractOutputConverter Класс для конвертирования содержимого в строчный формат.
     */
    private $_outputConverter;

    /**
     * Инициализация всех фабричных компонентов.
     * Для дальнейшего использования в парсере.
     * @see Parser
     */
    public function init() : void
    {
        $this->_reader = $this->_createReader();
        $this->_parser = $this->_createParser();
        $this->_soringMethod = $this->_createSoringMethod();
        $this->_outputConverter = $this->_createOutputConverter();
    }

    /**
     * @return AbstractReader
     */
    public function getReader(): AbstractReader
    {
        return $this->_reader;
    }

    /**
     * @return AbstractParser
     */
    public function getParser(): AbstractParser
    {
        return $this->_parser;
    }

    /**
     * @return AbstractSortingMethod
     */
    public function getSoringMethod(): AbstractSortingMethod
    {
        return $this->_soringMethod;
    }

    /**
     * @return AbstractOutputConverter
     */
    public function getOutputConverter(): AbstractOutputConverter
    {
        return $this->_outputConverter;
    }



    /**
     * @return AbstractReader
     */
    abstract protected function _createReader(): AbstractReader;

    /**
     * @return AbstractParser
     */
    abstract protected function _createParser(): AbstractParser;

    /**
     * @return AbstractSortingMethod
     */
    abstract protected function _createSoringMethod(): AbstractSortingMethod;

    /**
     * @return AbstractOutputConverter
     */
    abstract protected function _createOutputConverter(): AbstractOutputConverter;
}