<?php

return [

    'default' => env('LDAP_CONNECTION', 'default'),

    'connections' => [
        'default' => [
            'hosts' => [env('LDAP_HOST' )],
            'port' => env('LDAP_PORT'),
            'base_dn' => env('LDAP_BASE_DN'),
            'username' => env('LDAP_USERNAME'),
            'password' => env('LDAP_PASSWORD'),
            'timeout' => 5,
            'use_ssl' => false,
            'use_tls' => false,
        ],

    ],

];
