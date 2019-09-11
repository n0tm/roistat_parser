<?php


namespace RoistatParser\SortingMethods;


use RoistatParser\Model\AccessLogItem;
use RoistatParser\Parsers\AbstractParser;

/**
 * Class AbstractSortingMethod Абстрактный класс, который наследуется любым сортировочным алгоритмом.
 * @package RoistatParser\SortingMethods
 */
abstract class AbstractSortingMethod
{
    /**
     * @type array
     */
    private $_data;

    /**
     * @return array Возвращает массив отсортированных данных.
     * @see AbstractSortingMethod::sort() Метод сортировки определённым алгоритмом.
     */
    public function getData(): array
    {
        return $this->_data;
    }

    /**
     * @param AccessLogItem[] Массив преобразованных в упрощённые модели строк лог файла.
     * @see AbstractParser Класс который преобразует массивы данных в упрощённые модели.
     */
    public function sort($accessLogItems): void {
        $this->_sort($accessLogItems);
        $this->_data = $this->_convertSortDataToArray();
    }

    /**
     * Сортирует массив по переданному алгоритму.
     * @param AccessLogItem[] Массив преобразованных в упрощённые модели строк лог файла.
     */
    abstract protected function _sort($accessLogItems): void;

    /**
     * @return array Возвращает массив, который конвертирует после сортировки.
     * @see AbstractSortingMethod::_sort()
     */
    abstract protected function _convertSortDataToArray(): array;
}