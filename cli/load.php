<?php

require __DIR__.'/../bootstrap.php';

use TutellusHall\Fame;

$query = json_decode(file_get_contents(__DIR__.'/../query/web.js'));
$layout = file_get_contents(__DIR__.'/../layout/grav/quark.html');

$html = (new Fame($query, $layout))->html();

print_r($html);
