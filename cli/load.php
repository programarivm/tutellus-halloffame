<?php

$query = json_decode(file_get_contents(__DIR__.'/../query/web.js'));
$layout = file_get_contents(__DIR__.'/../layout/grav/quark.html');

print_r($query);
print_r($layout);
