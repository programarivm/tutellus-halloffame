<?php

define('BASE_PATH', realpath(dirname(__FILE__)));

require BASE_PATH.'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();
