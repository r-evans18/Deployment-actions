<?php

namespace RC\DeploymentActions\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RC\DeploymentActions\Models\DeploymentActionLog;

class AccessController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        if (Hash::check($request->password, Auth::user()->password)) {
            if (!deployment_action_enabled($request->key)) {
                DeploymentActionLog::logDeploymentAction('deployment-access-request', false, 'Action is not enabled');
                return redirect()->back()->with('error', 'Action is not enabled! Action aborted.');
            }

            session(['deployment_action_granted' => true]);
            DeploymentActionLog::logDeploymentAction('deployment-access-request', true);
            return redirect()->route('deployment-actions.run-command', $request->command);
        }

        DeploymentActionLog::logDeploymentAction('deployment-access-request', false, 'Password is incorrect');
        return redirect()->back()->with('error', 'Password is incorrect! Action aborted.');
    }
}
