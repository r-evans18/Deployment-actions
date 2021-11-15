<div class="modal fade" id="deploymentActionPrompt-{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="deploymentActionPromptLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('deployment-actions.access.prompt') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="deploymentActionPromptLabel">Deployment action: <b>{{ $title }}</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Are you sure you want to run: <b>{{ $title }}</b>?
                    </p>

                    <div class="text-center">
                        <p class="text-danger"><b>Please re-enter your password to run this command: <code>{{ $command }}</code></b></p>
                    </div>

                    <input type="password" name="password" class="form-control" placeholder="Password..." required>
                    <input type="text" class="form-control" name="key" hidden value="{{ $key }}" required>
                    <input type="text" class="form-control" name="command" hidden value="{{ $command }}" required>

                    @if (is_production() == true)
                        <div class="text-center mt-4">
                            <p class="text-danger"><b>This site is currently in production. Are you sure you want to run this command?</b></p>
                            <div class="form-check">
                                <input type="checkbox" id="force_command" name="force_command" required>
                                <label for="force_command">I agree to run this command on production</label>
                            </div>
                        </div>

                        @if (has_production_password() == true)
                            <div class="form-group">
                                <label for="production_password">Enter the secure production password:</label>
                                <input type="password" name="production_password" id="production_password" class="form-control" placeholder="Production secure password..." required>
                            </div>
                        @endif
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('There is not turning back! Are you sure?')">Run command</button>
                </div>
            </form>
        </div>
    </div>
</div>
