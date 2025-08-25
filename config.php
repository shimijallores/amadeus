<?php

return [
    'database' => [
        'host' => $_ENV['DATABASE_HOSTNAME'],
        'port' => $_ENV['DATABASE_PORT'],
        'dbname' => $_ENV['DATABASE_NAME'],
        'charset' => $_ENV['DATABASE_CHARSET'],
    ],
];
