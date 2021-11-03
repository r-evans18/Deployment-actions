<?php

namespace RC\DeploymentActions\Http\Middleware;

use Closure;

class DeploymentActionRun
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!session()->get('deployment_action_granted')) {
            return redirect()->back()->with('error', 'Unable to run deployment action. Invalid session key.');
        }

        return $next($request);
    }
}
