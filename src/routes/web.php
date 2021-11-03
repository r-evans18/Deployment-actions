<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'RC\DeploymentActions\Http\Controllers',
    'middleware' => ['web', 'auth']
], function () {
    Route::get('deployment-actions', 'IndexController')->name('deployment-actions.index');
    Route::post('/deployment-actions/access-prompt', 'AccessController')->name('deployment-actions.access.prompt');

    Route::group([
        'middleware' => ['deploymentActionRun'],
        'prefix' => 'deployment-actions',
        'as' => 'deployment-actions.',
    ], function () {
        Route::get('/run-command/{command}', 'RunCommandController')->name('run-command');
    });
});
