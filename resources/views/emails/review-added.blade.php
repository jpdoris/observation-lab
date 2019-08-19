@component('mail::message')
@include('emails.header')

## Concern Reviewed

Concern #{{ $report->id }} for {{ $report->patient->readableName() }} has been reviewed by {{ $reviewer->readableName() }}.

@component('mail::button', ['url' => route('report.show', ['id' => $report->id]) ])
View Report Detail
@endcomponent

@include('emails.footer')

@endcomponent
