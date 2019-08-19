@extends('layouts.app')

@section('content')
<div class="container-fluid center">
    <div class="row">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success save-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
              <div class="card-header">
                <h2>Active Concerns</h2>
              </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col" class="d-none d-xl-block">Report ID</th>
                                <th scope="col">Patient ID</th>
                                <th scope="col">Status</th>
                                <th scope="col">Assigned To</th>
                                <th scope="col" class="d-none d-xl-block"><a class="sort-reports" data-column="created_at" href="#">Creation Date</a>
                                    @if ($sort_options['reports']['sortby'] == "created_at")
                                        <span class="fa fa-chevron-circle-{{ $sort_options['reports']['arrow'] }}"></span>
                                    @endif
                                </th>
                                <th scope="col">Concern</th>
                                <th scope="col"><a class="sort-reports" data-column="updated_at" href="#">Last Updated</a>
                                    @if ($sort_options['reports']['sortby'] == "updated_at")
                                        <span class="fa fa-chevron-circle-{{ $sort_options['reports']['arrow'] }}"></span>
                                    @endif
                                </th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($activeReports as $report)
                              <tr data-id="{{ $report->id }}" class="table-row-select">
                                <td class="d-none d-xl-block">{{ $report->id }}</td>
                                <td>{{ $report->patient->name }}</td>
                                <td>{{ (isset($report->status->name) ? $report->status->name : "") }}</td>
                                <td>{{ ($report->assignedto == null ? '' : $report->assignedto->readableName()) }}
                                    @if($report->assignedto != auth()->user())
                                        <a class="assign-to-me" href="#" data-id="{{ $report->id }}" data-userid="{{ auth()->user()->id }}">[Assign to Me]</a>
                                    @endif
                                </td>
                                <td class="d-none d-xl-block">{{ $report->created_at->format('n/d/Y g:i a') }}</td>
                                <td>{{ $report->concernquality->name }}{{ (isset($report->concernlocation->name) ? " - " . $report->concernlocation->name : "") }}</td>
                                <td>{{ $report->updated_at->format('n/d/Y') }} <span class="d-none d-xl-block"> {{ $report->updated_at->format('g:i a') }}</span></td>
                                <td>
                                    <div class="actions d-none d-xl-block">
                                        <a class="btn btn-sm btn-secondary" href="{{ action('ReportController@show', ['id' => $report->id]) }}">View</a>
                                        @if($report->status->name != 'Closed')
                                        | <a class="btn btn-primary btn-sm" href="{{ action('ReviewController@create', ['id' => $report->id]) }}" id="report-review">Review</a> |
                                        <a class="btn btn-primary btn-sm" href="{{ action('TreatmentController@create', ['id' => $report->id]) }}" id="report-treatment">Treat</a> |
                                        <a class="btn btn-danger btn-sm" href="{{ action('CloseoutController@create', ['id' => $report->id]) }}" id="report-closeout">Close</a>
                                      @endif
                                    </div>
                                    <div class="dropdown d-xl-none">
                                      <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" href="{{ action('ReportController@show', ['id' => $report->id]) }}">View</a>
                                          @if($report->status->name != 'Closed')
                                          <a class="dropdown-item" href="{{ action('ReviewController@create', ['id' => $report->id]) }}">Review</a>
                                          <a class="dropdown-item" href="{{ action('TreatmentController@create', ['id' => $report->id]) }}">Treat</a>
                                          <a class="dropdown-item" href="{{ action('CloseoutController@create', ['id' => $report->id]) }}">Close</a>
                                          @endif
                                      </div>
                                    </div>
                                </td>
                              </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $activeReports->links('vendor.pagination.bootstrap-4'); !!}
                    </div>
                </div>

                <div class="card-footer text-right">
                  <a href="{{ route('report.create') }}" class="btn btn-sm btn-primary">New Report</a>
                </div>
            </div>
            @if(!$closedReports->isEmpty())
            <div class="card mt-5">
              <div class="card-header">
                <h2>Concern History</h2>
              </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col" class="d-none d-xl-block">Report ID</th>
                                <th scope="col">Patient ID</th>
                                <th scope="col" class="d-none d-xl-block"><a class="sort-history" data-column="created_at" href="#">Creation Date</a>
                                    @if ($sort_options['history']['sortby'] == "created_at")
                                        <span class="fa fa-chevron-circle-{{ $sort_options['history']['arrow'] }}"></span>
                                    @endif
                                </th>
                                <th scope="col">Concern</th>
                                <th scope="col"><a class="sort-history" data-column="updated_at" href="#">Last Updated</a>
                                    @if ($sort_options['history']['sortby'] == "updated_at")
                                        <span class="fa fa-chevron-circle-{{ $sort_options['history']['arrow'] }}"></span>
                                    @endif
                                </th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($closedReports))
                              @foreach($closedReports as $report)
                              <tr data-id="{{ $report->id }}" class="table-row-select">
                                <td class="d-none d-xl-block">{{ $report->id }}</td>
                                <td>{{ $report->patient->name }}</td>
                                <td class="d-none d-xl-block">{{ $report->created_at->format('n/d/Y g:i:s') }}</td>
                                <td>{{ $report->concernquality->name }}{{ (isset($report->concernlocation->name) ? " - " . $report->concernlocation->name : "") }}</td>
                                <td>{{ $report->updated_at->format('n/d/Y') }} <span class="d-none d-xl-block"> {{ $report->updated_at->format('g:i a') }}</span></td>
                                <td>
                                    <div class="actions">
                                        <a class="btn btn-sm btn-secondary" href="{{ action('ReportController@show', ['id' => $report->id]) }}">View</a>
                                    </div>
                                </td>
                              </tr>
                              @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer text-right">
                  <a href="{{ route('history')}}" class="btn btn-sm btn-secondary">View All</a>
                    {{ csrf_field() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<div id="sort-options" class="d-none">{{ json_encode($sort_options) }}</div>
@include('shared.modal-alert')
@endsection
