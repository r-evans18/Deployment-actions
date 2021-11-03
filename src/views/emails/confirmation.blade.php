@component('mail::message')
# Deployment Action Executed!

Please review the following details from the deployment action which was executed at: **{{ $log->created_at }}**.

**User:** {{ $log->user->name }}<br>
**Action:** {{ $log->action }}<br>
**Successful:** {{ $log->successful ? 'Yes' : 'No' }}<br>
**Error:** {{ $log->error ?: 'N/A' }}<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
