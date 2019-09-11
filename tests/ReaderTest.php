<?php

use PHPUnit\Framework\TestCase;
use RoistatParser\Readers\FileReader;

class ReaderTests extends TestCase
{

    const ACCESS_LOG_PATH = "../../examples/access_logs/access_log2.log";

    public function testReader()
    {
        $readerData = $this->_readFile(self::ACCESS_LOG_PATH);

        $fileData = file_get_contents(self::ACCESS_LOG_PATH);
        $explodedFileData = explode(PHP_EOL, $fileData);

        $this->assertSame($explodedFileData, $readerData);
    }

    private function _readFile($pathToFile)
    {
        $reader = new FileReader($pathToFile);
        $reader->read();

        return $reader->getData();
    }

}