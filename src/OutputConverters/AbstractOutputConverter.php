<?php


namespace RoistatParser\OutputConverters;


/**
 * Class AbstractOutputConverter Класс для преобразования отформатированных данных в определённый формат. Пока интегрированна только поддержка JSON.
 * @package RoistatParser\OutputConverters
 */
abstract class AbstractOutputConverter
{
    /**
     * @type string $_data Конвертированные данные в строчный формат.
     * @see AbstractOutputConverter::convert()
     */
    private $_data;

    /**
     * Метод конвертирует массив данных в нужный строчный формат.
     * @param array Массив данных которые нужно преобразовать в определённый формат.
     * @see AbstractOutputConverter::_convert()
     */
    public function convert(array $data): void {
        $this->_data = $this->_convert($data);
    }

    /**
     * @return string Возвращает сконвертированные данные в строчный формат.
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * Конвертирует данные в строчный формат.
     * @param array $data Массив данных которые нужно преобразовать в определённый формат.
     * @return string Возвращает сконвертированные данные в строчный формат.
     */
    abstract protected function _convert(array $data);
}