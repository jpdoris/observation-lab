@component('mail::message')
@include('emails.header')

## Concern Closed

Concern #{{ $report->id }} for {{ $report->patient->readableName() }} has been closed by {{ $closedby->readableName() }} at {{ $report->updated_at->format('n/d/Y g:i a') }}

@component('mail::button', ['url' => route('report.show', ['id' => $report->id]) ])
View Report Detail
@endcomponent

@include('emails.footer')

@endcomponent
