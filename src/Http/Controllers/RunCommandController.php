<?php

namespace RC\DeploymentActions\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use RC\DeploymentActions\Models\DeploymentActionLog;

class RunCommandController extends Controller
{
    public function __invoke($command, $seeder = null): RedirectResponse
    {
        $successful = true;
        $exception = null;
        if ($seeder == "1") {
            try {
                Artisan::call('db:seed', [
                    '--class' => $command,
                    '--force' => is_production()
                ]);
            } catch (\Exception $exception) {
                $successful = false;
                Log::error('Unable to run command: ' . 'Seeder: True ' . '-' . $command . ' due to: ' . $exception);
            }
        } else {
            try {
                Artisan::call($command, ['--force' => is_production()]);
            } catch (\Exception $exception) {
                $successful = false;
                Log::error('Unable to run command: ' . $command . ' due to: ' . $exception);
            }
        }

        DeploymentActionLog::logDeploymentAction('Seeder:' . $seeder == "1" ? true : false . ' - ' . $command, $successful, $exception, is_production());

        if (!$successful) {
            return redirect()->back()
                ->with('error', 'An error occurred running command:' . $command . '. Please check action logs for error message');
        }

        return redirect()->back()->with('success', 'Command: ' . $command . ' has been run successfully.');
    }
}
