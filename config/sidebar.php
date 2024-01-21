<?php

return [

    'default' => [
        [
            'icon' => 'fa fa-th-large',
            'title' => 'Dashboard',
            'url' => '/dashboard',
        ],
        [
            'icon' => 'fa fa-address-book',
            'title' => 'Registration',
            'url' => '/registration',
        ],
        [
            'icon' => 'fa fa-user',
            'title' => 'Users',
            'url' => 'javascript:;',
            'caret' => true,
            'sub_menu' => [
                [
                    'url' => '/student',
                    'title' => 'Student',
                ],
                [
                    'url' => '/teacher',
                    'title' => 'Teacher',
                ],
                [
                    'url' => '/user',
                    'title' => 'User',
                ],
            ],
        ],
        [
            'icon' => 'fas fa-school',
            'title' => 'Class',
            'url' => '/class',
        ],
        [
            'icon' => 'fas fa-pencil-alt fa-fw',
            'title' => 'Achievement',
            'url' => '/achievement',
        ],
        [
            'icon' => 'fas fa-book fa-fw',
            'title' => 'Extracurricular',
            'url' => '/extracurricular',
        ],
    ],

    'student' => [
        [
            'icon' => 'fa fa-th-large',
            'title' => 'Dashboard',
            'url' => '/dashboard',
        ],
        [
            'icon' => 'fa fa-user',
            'title' => 'Users',
            'url' => 'javascript:;',
            'caret' => true,
            'sub_menu' => [
                [
                    'url' => '/student',
                    'title' => 'Student',
                ],
                [
                    'url' => '/user',
                    'title' => 'User',
                ],
            ],
        ],
    ],

    // Add more roles as needed...

];
