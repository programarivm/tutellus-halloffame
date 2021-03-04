<?php

require __DIR__.'/bootstrap.php';
require APP_PATH.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

$query = json_decode(file_get_contents(__DIR__.'/../query/web.js'));
$layout = file_get_contents(__DIR__.'/../layout/grav/quark.html');

print_r($query);
print_r($layout);
