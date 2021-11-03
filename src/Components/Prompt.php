<?php

namespace RC\DeploymentActions\Components;

use Illuminate\View\Component;

class Prompt extends Component
{
    public $key;
    public $title;
    public $description;
    public $command;

    /**
     * Create a new component instance.
     *
     * @param string $key
     * @param string $title
     * @param string $description
     * @param string $command
     */
    public function __construct(string $key, string $title, string $description, string $command)
    {
        $this->key = $key;
        $this->title = $title;
        $this->description = $description;
        $this->command = $command;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('deployment-actions::components.deployment-action-prompt');
    }
}
