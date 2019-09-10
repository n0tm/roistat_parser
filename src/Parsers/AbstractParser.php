<?php


namespace RoistatParser;


use RoistatParser\Model\AccessLogItem;

abstract class AbstractParser
{
    /**
     * @type AccessLogItem[]
     */
    private $_convertedItems;

    /**
     * @type mixed[]
     */
    private $_convertedObjects;

    /**
     * @return AccessLogItem[]
     */
    public function getConvertedItems(): array
    {
        return $this->_convertedItems;
    }

    /**
     * @return mixed[]
     */
    public function getConvertedObjects(): array
    {
        return $this->_convertedObjects;
    }


    public function parse(array $data): void {

        foreach ($data as $item) {
            $convertedObject = $this->_convertToObject($item);
            $convertedItem = $this->_convertToLogItem($convertedObject);

            $this->_convertedObjects[] = $convertedObject;
            $this->_convertedItems[] = $convertedItem;
        }

    }

    abstract protected function _convertToLogItem(array $data): AccessLogItem;
    abstract protected function _convertToObject(?string $data): array;
}