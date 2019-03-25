<?php

return [
    'collections' => [
        'docs' => [
            'extends' => '_layouts.documentation',
            'name' => 'Maizzle PHP Email Framework',
            'path' => 'docs/{-filename}',
            'version' => 'vD.E.V',
            'thumbnail' => '/img/logo-light.png',
            'sort' => 'page_order',
            'social' => [
                'github' => 'https://github.com/maizzle',
                'twitter' => 'https://twitter.com/maizzlejs',
                'envato' => 'https://themeforest.net/user/thememountain/portfolio?ref=thememountain',
            ],
        ],
    ],
    'production' => false,
    'build' => [
        'source' => 'source',
        'destination' => 'build_local',
    ],

    /*
    |--------------------------------------------------------------------------
    | Helper Functions
    |--------------------------------------------------------------------------
    |
    */

    'getSVG' => function($name) {
        return __DIR__ . '/source/img/icons/'.$name.'.svg';
    },
    'active' => function ($page, $path) {
        $pages = collect(array_wrap($page));

        return $pages->contains(function ($page) use ($path) {
            return str_is($page->getPath(), $path['path']);
        });
    },
    'hasChildrenActive' => function ($page, $children) {
        $children = collect($children);

        return $children->contains(function ($link) use ($page) {
            return $page->getPath() == $link['path'];
        });
    },
];
