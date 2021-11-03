<?php

return [

    /*
     * Turn on notifications to be sent when an action is run.
     */
    'enable_notifications' => true,

    /*
     * Enter an array of email addresses the email needs to be sent to when an action is run.
     */
    'notification_emails' => [
      [
          'email' => ''
      ],
    ],

    /*
     * The production password adds an extra step of security when running commands on production sites.
     */
    'production_password' => env('DEPLOYMENT_PRODUCTION_PASSWORD', null),

    /*
     * To activate actions you would like on your deployment screen, simply add the key to the
     * activeActions array below.
     */
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
