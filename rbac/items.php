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
    'seeDictionaries' => [
        'type' => 2,
    ],
    'setDictionaries' => [
        'type' => 2,
    ],
    'seeUMK' => [
        'type' => 2,
    ],
    'setUMK' => [
        'type' => 2,
    ],
    'seeResources' => [
        'type' => 2,
    ],
    'setResources' => [
        'type' => 2,
    ],
    'setInternetResources' => [
        'type' => 2,
    ],
    'setNewResource' => [
        'type' => 2,
    ],
    'confirmRequest' => [
        'type' => 2,
    ],
    'denyRequest' => [
        'type' => 2,
    ],
    'completeRequest' => [
        'type' => 2,
    ],
    'confirmUMK' => [
        'type' => 2,
    ],
    'denyUMK' => [
        'type' => 2,
    ],
    'manageUser' => [
        'type' => 2,
    ],
    'guest' => [
        'type' => 1,
        'children' => [
            'login',
            'logout',
            'error',
            'registration',
            'seeDictionaries',
            'seeResources',
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
            'setDictionaries',
            'manageUser',
        ],
    ],
    'department-e' => [
        'type' => 1,
        'children' => [
            'update',
            'delete',
            'seeUMK',
            'setUMK',
            'create',
            'guest',
            'setInternetResources',
            'setNewResource',
        ],
    ],
    'department-h' => [
        'type' => 1,
        'children' => [
            'department-e',
            'confirmRequest',
            'denyRequest',
            'confirmUMK',
            'denyUMK',
        ],
    ],
    'library-e' => [
        'type' => 1,
        'children' => [
            'update',
            'delete',
            'create',
            'guest',
            'setResources',
            'completeRequest',
            'denyRequest',
        ],
    ],
];
