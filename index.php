<?php

namespace Liloi\Euphoria;

include_once __DIR__ . '/RuneFramework.phar';
include_once __DIR__ . '/Application.php';

$private = json_decode(file_get_contents('./Config.json'), true);

$config = array_merge([
    'title' => 'Euphoria',
    'start' => 'Requests.layout();',
    'scripts' => [
        $private['root'] . '/Requests.js'
    ],
    'prefix' => 'euphoria_'
], $private);

$app = new Application($config);

echo $app->compile();