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
            if (has_production_password()) {
                if ($request->production_password != config('deployment.production_password')) {
                    DeploymentActionLog::logDeploymentAction('deployment-access-request', false, 'Production password does not match');
                    return redirect()->back()->with('error', 'Production password does not match! Action aborted.');
                }
            }
            if (!deployment_action_enabled($request->key)) {
                DeploymentActionLog::logDeploymentAction('deployment-access-request', false, 'Action is not enabled');
                return redirect()->back()->with('error', 'Action is not enabled! Action aborted.');
            }

            session(['deployment_action_granted' => true]);
            DeploymentActionLog::logDeploymentAction('deployment-access-request', true);
            return redirect()->route('deployment-actions.run-command', [
                'command' => $request->command,
                'seeder' => $request->seeder,
            ]);
        }

        DeploymentActionLog::logDeploymentAction('deployment-access-request', false, 'Password is incorrect');
        return redirect()->back()->with('error', 'Password is incorrect! Action aborted.');
    }
}
