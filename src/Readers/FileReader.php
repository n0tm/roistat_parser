<?php


namespace RoistatParser\Readers;

use Generator;

/**
 * Class FileReader Класс для чтения .log файла.
 * @package RoistatParser\Readers
 */
class FileReader extends AbstractReader
{
    /**
     * @var string Путь до читаемого файла.
     */
    private $_pathToFile;

    /**
     * FileReader constructor.
     * @param string|null $pathToFile Путь до читаемого файла.
     */
    public function __construct(?string $pathToFile)
    {
        $this->_pathToFile = $pathToFile;
    }

    /**
     * @return Generator Возвращает генератор данных. Результат будет передан в метод форматирования.
     * @see FileReader::_format()
     */
    protected function _load(): Generator
    {
        return $this->_readLineByLine();
    }

    /**
     * Метод генератора, который читает .log файл.
     * @return Generator возвращает генератор данных.
     */
    private function _readLineByLine()
    {
        $handle = fopen($this->_pathToFile, "r");

        while(!feof($handle)) {
            $raw = fgets($handle);
            yield trim($raw);
        }

        fclose($handle);
    }

    /**
     * @param Generator $loadedData Генератор данных, из метода генератора.
     * @return array Возвращает отформатированный массив данных.
     * @see FileReader::_load()
     */
    protected function _format($loadedData): array
    {
        $result = [];

        foreach ($loadedData as $dataItem) {
            $result[] = $dataItem;
        }

        return $result;
    }
}