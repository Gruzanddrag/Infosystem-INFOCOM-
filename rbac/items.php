<?php
return [
    'login' => [
        'type' => 2,
    ],
    'logout' => [
        'type' => 2,
    ],
    'error' => [
        'type' => 2,
    ],
    'registration' => [
        'type' => 2,
    ],
    'index' => [
        'type' => 2,
    ],
    'view' => [
        'type' => 2,
    ],
    'update' => [
        'type' => 2,
    ],
    'delete' => [
        'type' => 2,
    ],
    'create' => [
        'type' => 2,
    ],
    'test' => [
        'type' => 2,
    ],
    'guest' => [
        'type' => 1,
        'children' => [
            'login',
            'logout',
            'error',
            'registration',
            'index',
            'view',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'department-e',
            'library-e',
            'department-h',
            'test',
        ],
    ],
    'department-e' => [
        'type' => 1,
        'children' => [
            'update',
            'delete',
            'create',
            'guest',
        ],
    ],
    'department-h' => [
        'type' => 1,
        'children' => [
            'department-e',
        ],
    ],
    'library-e' => [
        'type' => 1,
        'children' => [
            'update',
            'delete',
            'create',
            'guest',
        ],
    ],
];
