<?php


namespace RoistatParser\Parsers;


use RoistatParser\Exceptions\AbstractParserException;
use RoistatParser\Model\AccessLogItem;

/**
 * Class AbstractParser Класс парсинга определённого содержимого
 * @package RoistatParser\Parsers
 */
abstract class AbstractParser
{
    /**
     * @type AccessLogItem[] Массив спарсенных упрощённых моделей.
     * @see AbstractParser::$_convertedItems
     */
    private $_convertedItems;

    /**
     * @type array Данные отформатированые в массив.
     * @see AbstractParser::$_convertedArray
     */
    private $_convertedArray;

    /**
     * @return AccessLogItem[] Возвращает массив спарсенных упрощённых моделей.
     * @see AbstractParser::$_convertedItems
     */
    public function getConvertedItems(): array
    {
        return $this->_convertedItems;
    }

    /**
     * @return mixed Возвращает конфертированные в массив данные.
     * @see AbstractParser::$_convertedArray
     */
    public function getConvertedArray(): array
    {
        return $this->_convertedArray;
    }


    /**
     * Метод парсинга содержиомго.
     * Метод конвертирует содержимое в массив, а после конвертирует в упрощённую модель.
     * @param mixed $data Данные для парсинга.
     */
    public function parse(array $data): void {

        foreach ($data as $item) {

            try {
                $convertedObject = $this->_convertToArray($item);
            } catch (AbstractParserException $e) {
                $message = sprintf("%s\nПропускаю эту строку...\n\n", $e->toString());
                echo $message;
                continue;
            }

            $convertedItem = $this->_convertToLogItem($convertedObject);

            $this->_convertedArray[] = $convertedObject;
            $this->_convertedItems[] = $convertedItem;
        }

    }

    /**
     * @param array $data Массив данных, который нужно конвертировать в модель.
     * @return AccessLogItem Cпарсенная упрощённая модель.
     */
    abstract protected function _convertToLogItem(array $data): AccessLogItem;

    /**
     * @param mixed $data Данные, которые нужно конвертировать в массив.
     * @return array Возвращает конвертиорванные данные в массив.
     * @throws AbstractParserException Выбрасывает AbstractParserException, если на этапе парсинга массива возникли ошибки.
     */
    abstract protected function _convertToArray($data): array;
}