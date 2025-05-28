<?php

return [

    'default' => env('LDAP_CONNECTION', 'default'),

    'connections' => [
        'default' => [
            'hosts' => [env('LDAP_HOST', '10.20.30.5')],
            'port' => env('LDAP_PORT', 389),
            'base_dn' => env('LDAP_BASE_DN', 'dc=local,dc=pharma'),
            'username' => env('LDAP_USERNAME', 'cn=glpi,dc=local,dc=pharma'),
            'password' => env('LDAP_PASSWORD', 'pharma@2025'),
            'timeout' => 5,
            'use_ssl' => false,
            'use_tls' => false,
        ],

    ],

];
