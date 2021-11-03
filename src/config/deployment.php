<?php

return [

    /*
     * To activate actions you would like on your deployment screen, simply add the key to the
     * activeActions array below.
     */

    'notification_email' => env('DEPLOYMENT_ACTION_EMAIL', null),

    'activeActions' => [
        'migrate',
    ],

    'actions' => [
        [
            'key' => 'migrate',
            'title' => 'Migrate',
            'command' => 'migrate',
        ],
    ],

    'commands' => [

    ]
];