<?php

use KocicakEET\Executor;

require_once (__DIR__ . "/vendor/autoload.php");
//require_once (__DIR__ . "/KocicakEET/Executor.php");

$executor = new Executor();
$executor->Execute($argv);