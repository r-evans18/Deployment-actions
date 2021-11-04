<?php

namespace RC\DeploymentActions\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use RC\DeploymentActions\Models\DeploymentActionLog;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        return view('deployment-actions::index', [
            'logs' => DeploymentActionLog::orderBy('id', 'desc')->paginate(10)
        ]);
    }
}
