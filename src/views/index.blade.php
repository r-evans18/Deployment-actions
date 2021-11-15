@extends(config('deployment.layout_file'))

@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Deployment Actions</h4>
                </div>

                <div class="card-body">
                    @if (sizeof(config('deployment.activeActions')) == 0)
                        <p>
                            There are no active deployment actions.
                        </p>
                        <p>
                            <b>To enabled deployment actions open <code>config/deployment.php</code> and read further instructions.</b>
                        </p>
                    @endif
                    @foreach(config('deployment.actions') as $action)
                        @if (deployment_action_enabled($action['key']))
                            <a href='#deploymentActionPrompt' class="btn btn-danger" data-toggle="modal" data-target="#deploymentActionPrompt-{{ $action['key'] }}">
                                <i class="fas fa-exclamation-triangle"></i> {{ $action['title'] }}
                            </a>
                            <x-deployment-action-prompt
                                :key="$action['key']"
                                :title="$action['title']"
                                :description="$action['title']"
                                :command="$action['command']"
                            ></x-deployment-action-prompt>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Deployment Commands</h4>
                </div>
                <div class="card-body">
                    @if (sizeof(config('deployment.activeActions')) == 0)
                        <p>
                            There are no active deployment commands.
                        </p>
                        <p>
                            <b>To enabled deployment commands open <code>config/deployment.php</code> and read further instructions.</b>
                        </p>
                    @endif
                    @foreach(config('deployment.commands') as $command)
                        @if (deployment_action_enabled($command['key']))
                            <a href='#deploymentActionPrompt' class="btn btn-danger" data-toggle="modal" data-target="#deploymentActionPrompt-{{ $command['key'] }}">
                                <i class="fas fa-exclamation-triangle"></i> {{ $command['title'] }}
                            </a>
                            <x-deployment-action-prompt
                                :key="$command['key']"
                                :title="$command['title']"
                                :description="$command['title']"
                                :command="$command['command']"
                            ></x-deployment-action-prompt>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Deployment History</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Action</th>
                                    <th>Performed By</th>
                                    <th>Executed At</th>
                                    <th>Successful</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <td>{{ $log->id }}</td>
                                        <td>{{ $log->action }} @if($log->forced) (<span class="text-danger"><b>FORCED</b></span>) @endif</td>
                                        <td>{{ $log->user->name }}</td>
                                        <td>{{ $log->created_at }}</td>
                                        <td>
                                            @if($log->successful)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </td>
                                        <td>{{ $log->error }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
