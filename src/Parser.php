<?php


namespace RoistatParser;


use RoistatParser\Fabrics\AbstractParserFabric;

/**
 * Class Parser Главный класс для парсинга чего-либо. Пока интегрирована поддержка только .log файлов.
 * @package RoistatParser
 */
class Parser
{
    /**
     * @type AbstractParserFabric Фабрика для получения компонентов чтения, парсинга, сортировки и вывода.
     */
    private $_fabric;

    /**
     * Parser constructor.
     * @param AbstractParserFabric $fabric Принимает фабрику для получения компонентов чтения, парсинга, сортировки и вывода.
     */
    public function __construct(AbstractParserFabric $fabric)
    {
        $this->_fabric = $fabric;
    }

    /**
     * @return AbstractParserFabric Отдаёт фабрику для получения компонентов чтения, парсинга, сортировки и вывода.
     */
    public function getFabric()
    {
        return $this->_fabric;
    }


    /** TODO:
     * 3. Написать тесты.
     */

    /**
     * @return mixed Главный метод класса. Читает содержимое, парсит содержимое, комплектует содержимое переданным алгоритмом и форматирует его в нормальный вид.
     */
    public function parse()
    {
        $this->_fabric->getReader()->read();
        $readerData = $this->_fabric->getReader()->getFormattedData();

        $this->_fabric->getParser()->parse($readerData);
        $parserData = $this->_fabric->getParser()->getConvertedItems();

        $this->_fabric->getSoringMethod()->sort($parserData);
        $sortedData = $this->_fabric->getSoringMethod()->getSortedData();

        $this->_fabric->getOutputConverter()->convert($sortedData);
        return $this->_fabric->getOutputConverter()->getData();
    }
}