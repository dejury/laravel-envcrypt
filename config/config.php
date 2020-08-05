<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'key'      => config('app.key'),
    'cipher'   => config('app.cipher'),
    'location' => base_path(),
    'editor'   => 'nano',

    'environments' => [
        'local',
        'staging',
        'production',
    ],
];