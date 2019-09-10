<?php


namespace RoistatParser;


abstract class AbstractReader
{
    /**
     * @type array
     */
    private $_data = [];

    /**
     * @var
     */
    // Полиция Code Conventions не оценит это.
    private $_loadedData;

    /**
     * @return mixed
     */
    public function getLoadedData()
    {
        return $this->_loadedData;
    }


    /**
     * @return array
     */
    public function getData(): array {
        return $this->_data;
    }

    public function read(): void {
        $this->_loadedData = $this->_load();
        $this->_data = $this->_format($this->_loadedData);
    }

    /**
     * @param $loadedData
     * @return array
     */
    abstract protected function _format($loadedData): array;

    /**
     * @return mixed
     */
    abstract protected function _load();
}