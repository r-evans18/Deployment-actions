<?php

namespace RC\DeploymentActions\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use RC\DeploymentActions\Models\DeploymentActionLog;

class RunCommandController extends Controller
{
    public function __invoke($command): RedirectResponse
    {
        $successful = true;
        $exception = null;
        try {
            Artisan::call($command);
        } catch (\Exception $exception) {
            Log::error('Unable to run command: ' . $command . ' due to: ' . $exception);
        }

        DeploymentActionLog::logDeploymentAction($command, $successful, $exception);

        if (!$successful) {
            return redirect()->back()
                ->with('error', 'An error occurred running command:' . $command . '. Please check action logs for error message');
        }

        return redirect()->back()->with('success', 'Command: ' . $command . ' has been run successfully.');
    }
}
