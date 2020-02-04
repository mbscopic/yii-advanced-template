<?php
return [
    'backend' => [
        'frontName' => 'admin_1imo05'
    ],
    'crypt' => [
        'key' => '507c9eb9f2e3ca1d6b6dabcd773cba50'
    ],
    'db' => [
        'table_prefix' => '',
        'connection' => [
            'default' => [
                'host' => 'localhost',
                'dbname' => 'nuvolari',
                'username' => 'root',
                'password' => 'root',
                'active' => '1'
            ]
        ]
    ],
    'resource' => [
        'default_setup' => [
            'connection' => 'default'
        ]
    ],
    'x-frame-options' => 'SAMEORIGIN',
    'MAGE_MODE' => 'developer',
    'session' => [
        'save' => 'files'
    ],
    'cache' => [
        'frontend' => [
            'default' => [
                'id_prefix' => '8a1_'
            ],
            'page_cache' => [
                'id_prefix' => '8a1_'
            ]
        ]
    ],
    'lock' => [
        'provider' => 'db',
        'config' => [
            'prefix' => NULL
        ]
    ],
    'cache_types' => [
        'config' => 1,
        'layout' => 1,
        'block_html' => 1,
        'collections' => 1,
        'reflection' => 1,
        'db_ddl' => 1,
        'compiled_config' => 1,
        'eav' => 1,
        'customer_notification' => 1,
        'config_integration' => 1,
        'config_integration_api' => 1,
        'google_product' => 0,
        'full_page' => 0,
        'config_webservice' => 1,
        'translate' => 1,
        'vertex' => 1,
        'ec_cache' => 1
    ],
    'downloadable_domains' => [
        'localhost'
    ],
    'install' => [
        'date' => 'Mon, 21 Oct 2019 09:46:56 +0000'
    ]
];
