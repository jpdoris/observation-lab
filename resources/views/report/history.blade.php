@foreach($history as $activity)

  @if(isset($activity->reviewed_by))
    <div class="row mb-3">
        <div class="col">
            <div class="card">
                <div class="card-header bg-warning">Review</div>
                <div class="card-body">{{ $activity->comments }}</div>
                <div class="card-footer">Reviewed by {{ $activity->reviewedby->readableName() }} on {{ $activity->updated_at->format('n/d/Y') }} at {{ $activity->updated_at->format('g:i a') }}</div>
            </div>
        </div>
    </div>
  @endif

  @if(isset($activity->treated_by))
    <div class="row mb-3">
        <div class="col">
            <div class="card">
                <div class="card-header bg-info text-white">Treatment</div>
                <div class="card-body">{{ $activity->treatment }}</div>
                <div class="card-footer">Treated by {{ $activity->treatedby->readableName() }} on {{ $activity->updated_at->format('n/d/Y') }} at {{ $activity->updated_at->format('g:i a') }}</div>
            </div>
        </div>
    </div>
  @endif

  @if(isset($activity->closedby))
    <div class="row mb-3">
        <div class="col">
            <div class="card">
                <div class="card-header bg-success text-white">Closed Out</div>
                <div class="card-body">{{ $activity->comments }}</div>
                <div class="card-footer">Closed by {{ $activity->closedby->readableName() }} on {{ $activity->updated_at->format('n/d/Y') }} at {{ $activity->updated_at->format('g:i a') }}</div>
            </div>
        </div>
    </div>
  @endif

@endforeach
