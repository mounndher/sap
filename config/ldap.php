<?php

return [

    'default' => env('LDAP_CONNECTION', 'default'),

    'connections' => [

        'default' => [
            'hosts' => [env('LDAP_HOST', 'ldap.example.com')],
            'username' => env('LDAP_USERNAME', 'cn=admin,dc=example,dc=com'),
            'password' => env('LDAP_PASSWORD', ''),
            'port' => env('LDAP_PORT', 389),
            'base_dn' => env('LDAP_BASE_DN', 'dc=example,dc=com'),
            'timeout' => env('LDAP_TIMEOUT', 5),
            'use_ssl' => env('LDAP_USE_SSL', false),
            'use_tls' => env('LDAP_USE_TLS', false),
        ],

    ],

];
