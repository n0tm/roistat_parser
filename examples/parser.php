<?php

require "../vendor/autoload.php";

use RoistatParser\Fabrics\LogFileToJsonFabric;
use RoistatParser\Parser;

$pathToFile = $argv[1];

$fabric = new LogFileToJsonFabric();
$fabric->setLogFilePath($pathToFile);
$fabric->init();

$parser = new Parser($fabric);
$output = $parser->parse();

echo $output;

