<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */
    'menu' => [
        [
            'icon' => 'fa fa-th-large',
            'title' => 'Dashboard',
            'url' => '/',
        ],
        [
            'icon' => 'fa fa-user',
            'title' => 'Users',
            'url' => 'javascript:;',
            'caret' => true,
            'sub_menu' => [[
                'url' => '/student',
                'title' => 'Student',
            ],[
                'url' => '/teacher',
                'title' => 'Teacher'
            ],
            [
                'url' => '/user',
                'title' => 'User'
            ],
            ]
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
        ],]
    ];

