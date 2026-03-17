<?php

return [
    'manageBooks' => [
        'type' => 2,
        'description' => 'Управление книгами (добавление, редактирование, удаление)',
    ],
    'manageAuthors' => [
        'type' => 2,
        'description' => 'Управление авторами (добавление, редактирование, удаление)',
    ],
    'user' => [
        'type' => 1,
        'children' => [
            'manageBooks',
            'manageAuthors',
        ],
    ],
];
