<?php


namespace RoistatParser\OutputConverters;


/**
 * Class JSONOutputConverter Класс для конвертирования массива данных в JSON формат.
 * @package RoistatParser\OutputConverters
 */
class JSONOutputConverter extends AbstractOutputConverter
{

    /**
     * @param array Массив данных, которые нужно конвертировать.
     * @return string Возвращает строку JSON формата.
     */
    protected function _convert(array $data)
    {
        return json_encode($data, JSON_PRETTY_PRINT);
    }

}