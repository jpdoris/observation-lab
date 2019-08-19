<div class="row">
  <div class="col-6">
    <p><strong>Patient Name:</strong> {{ $report->patient->name }}</p>
    <p><strong>Status:</strong> {{ (isset($report->status->name) ? $report->status->name : "") }}</p>
    <p><strong>Concern Quality:</strong> {{ $report->concernquality->name }}</p>
    <p><strong>Concern Location:</strong> {{ (isset($report->concernlocation->name) ? $report->concernlocation->name : "") }}</p>
    <p><strong>Animal Type:</strong> {{ $report->animalType->name }} - {{ $report->animalSubtype->name }}</p>
    <p><strong>Study ID:</strong> {{ (isset($report->study->name) ? $report->study->name : '') }}</p>
  </div>
  <div class="col-6">
    <p><strong>Report ID:</strong> {{ $report->id }}</p>
    <p><strong>Last Update:</strong> {{ $report->updated_at->format('n/d/Y g:i a') }}</p>
    <p><strong>Date Created:</strong> {{ $report->created_at->format('n/d/Y g:i a') }}</p>
    <p><strong>Owner:</strong> {{ (null !== $report->owner->readableName() ? $report->owner->readableName() : '') }}</p>
    <p><strong>Reported By:</strong> {{ (isset($report->reportedby->id) ? $report->reportedby->readableName() : '') }}</p>
    <p><strong>Assigned To:</strong> {{ (isset($report->assignedto) ? $report->assignedto->readableName() : '') }}</p>
    <p><strong>Building:</strong> {{ $report->building->name }} - {{ $report->room->name }}</p>
  </div>
</div>
