<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/'.$_ENV['DB_PATH_MIGRATION'],
        'seeds' => '%%PHINX_CONFIG_DIR%%/'.$_ENV['DB_PATH_SEEDS']
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => $_ENV['PROJECT_ENVIRONMENT'],
        'production' => [
            'adapter' => $_ENV['DB_PROD_ADAPTER'],
            'host' => $_ENV['DB_PROD_HOST'],
            'name' => $_ENV['DB_PROD_NAME'],
            'user' => $_ENV['DB_PROD_USER'],
            'pass' => $_ENV['DB_PROD_PASS'],
            'port' => $_ENV['DB_PROD_PORT'],
            'charset' => $_ENV['DB_PROD_CHARSET'],
        ],
        'development' => [
            'adapter' => $_ENV['DB_DEV_ADAPTER'],
            'host' => $_ENV['DB_DEV_HOST'],
            'name' => $_ENV['DB_DEV_NAME'],
            'user' => $_ENV['DB_DEV_USER'],
            'pass' => $_ENV['DB_DEV_PASS'],
            'port' => $_ENV['DB_DEV_PORT'],
            'charset' => $_ENV['DB_DEV_CHARSET'],
        ],
        'testing' => [
            'adapter' => $_ENV['DB_TEST_ADAPTER'],
            'host' => $_ENV['DB_TEST_HOST'],
            'name' => $_ENV['DB_TEST_NAME'],
            'user' => $_ENV['DB_TEST_USER'],
            'pass' => $_ENV['DB_TEST_PASS'],
            'port' => $_ENV['DB_TEST_PORT'],
            'charset' => $_ENV['DB_TEST_CHARSET'],
        ]
    ],
    'version_order' => 'creation'
];
