<?php

namespace RC\DeploymentActions\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RC\DeploymentActions\Mail\DeploymentAction;

class DeploymentActionLog extends Model
{
    protected $table = 'deployment_action_logs';

    protected $fillable = [
        'user_id',
        'action',
        'successful',
        'error',
        'forced',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function logDeploymentAction(string $action, bool $successful, $error = null, $forced = false)
    {
        $log = DeploymentActionLog::create([
            'user_id' => Auth::user()->id,
            'action' => $action,
            'successful' => $successful,
            'error' => $error,
            'forced' => $forced,
        ]);

        Mail::to(config('deployment.notification_email'))->send(new DeploymentAction($log));

        if ($action != 'deployment-access-request') {
            self::removeDeploymentActionToken();
        }
    }

    public static function removeDeploymentActionToken()
    {
        session()->forget('deployment_action_granted');
    }
}
