<?php

namespace RC\DeploymentActions\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use RC\DeploymentActions\Models\DeploymentActionLog;

class DeploymentAction extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    private $log;

    public function __construct(DeploymentActionLog $log)
    {
        $this->log = $log;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('deployment-actions::emails.confirmation')
            ->subject('[IMPORTANT] - Deployment Action Executed')
            ->with([
                'log' => $this->log
            ]);
    }
}
