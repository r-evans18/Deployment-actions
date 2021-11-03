<?php

use RC\DeploymentActions\Models\DeploymentActionLog;

if (!function_exists('deployment_action_enabled')) {
    function deployment_action_enabled($deploymentAction): bool
    {
        if (in_array($deploymentAction, config('deployment.activeActions'))) {
            return true;
        }

        return false;
    }
}

if (!function_exists('log_deployment_action')) {
    function log_deployment_action(string $action, bool $successful, $error = null)
    {
        DeploymentActionLog::create([
            'user_id' => \Illuminate\Support\Facades\Auth::user()->id,
            'action' => $action,
            'successful' => $successful,
            'error' => $error,
        ]);

        if ($action != 'deployment-access-request') {
            remove_deployment_action_token();
        }
    }
}

if (!function_exists('remove_deployment_action_token')) {
    function remove_deployment_action_token()
    {
        session()->forget('deployment_action_granted');
    }
}
