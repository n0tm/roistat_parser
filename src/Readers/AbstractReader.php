<?php


namespace RoistatParser\Readers;


/**
 * Class AbstractReader Класс для чтения определённого содержимого. Пока интегрирована поддержка только .log файлов.
 * @package RoistatParser\Readers
 */
abstract class AbstractReader
{
    /**
     * @type array Преобразованные загруженные данные в массив.
     * @see AbstractReader::_format()
     */
    private $_data = [];

    /**
     * @var mixed $_loadedData Загруженные данные в любом формате, которые потом будут переданны в метод форматирования
     * @see AbstractReader::_load()
     */
    private $_loadedData; // Полиция Code Conventions не оценит эти dD.

    /**
     * @return mixed Возвращает загруженные данные.
     */
    public function getLoadedData()
    {
        return $this->_loadedData;
    }


    /**
     * @return array Возвращает отформатированные данные
     */
    public function getData(): array {
        return $this->_data;
    }

    /**
     * Читает содержимое и преобразует его в массив данных.
     */
    public function read(): void {
        $this->_loadedData = $this->_load();
        $this->_data = $this->_format($this->_loadedData);
    }

    /**
     * Метод форматирования данных в массив.
     * @param $loadedData
     * @return array
     */
    abstract protected function _format($loadedData): array;

    /**
     * Метод загрузки данных.
     * @return mixed
     */
    abstract protected function _load();
}