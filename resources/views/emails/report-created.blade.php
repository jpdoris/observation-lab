@component('mail::message')
@include('emails.header')

## New Report Created

A new concern has been created for {{ $report->patient->readableName() }} reported by {{ $report->reportedby->readableName() }}

@component('mail::button', ['url' => route('report.show', ['id' => $report->id]) ])
View Report Detail
@endcomponent

@include('emails.footer')

@endcomponent
