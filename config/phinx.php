<?php

require __DIR__ . '/../src/Bootstrap.php';

return
    [
        'paths' => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/../db/migrations',
            'seeds' => '%%PHINX_CONFIG_DIR%%/../db/seeds'
        ],
        'environments' => [
            'default_migration_table' => 'migrations',
            'default_environment' => 'default',
            'default' => [
                'adapter' => $_ENV['DB_CONNECTION'],
                'host' => $_ENV['DB_HOST'],
                'name' => $_ENV['DB_DATABASE'],
                'user' => $_ENV['DB_USERNAME'],
                'pass' => $_ENV['DB_PASSWORD'],
                'port' => $_ENV['DB_PORT'],
                'charset' => 'utf8mb4',
            ]
        ],
        'version_order' => 'creation'
    ];