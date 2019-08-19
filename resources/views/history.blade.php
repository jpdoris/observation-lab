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

            <div class="card mt-5">
              <div class="card-header">
                <h2>Concern History</h2>
              </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col">Patient ID</th>
                                <th scope="col" class="d-none d-xl-block"><a class="sort-history" data-column="created_at" href="#">Creation Date</a> @if ($sort_options['history']['sortby'] == "created_at")<span class="fa fa-chevron-circle-{{ $sort_options['history']['arrow'] }}"></span>@endif </th>
                                <th scope="col">Concern</th>
                                <th scope="col"><a class="sort-history" data-column="updated_at" href="#">Last Updated</a> @if ($sort_options['history']['sortby'] == "updated_at")<span class="fa fa-chevron-circle-{{ $sort_options['history']['arrow'] }}"></span>@endif </th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($closedReports as $report)
                            <tr data-id="{{ $report->id }}" class="table-row-select">
                                <td>{{ $report->patient->name }}</td>
                                <td class="d-none d-xl-block">{{ $report->created_at->format('n/d/Y') }}</td>
                                <td>{{ $report->concernquality->name }}{{ (isset($report->concernlocation->name) ? " - " . $report->concernlocation->name : "") }}</td>
                                <td class="sort-history">{{ $report->updated_at->format('n/d/Y') }}</td>
                                <td>
                                    <div class="actions">
                                        <a class="btn btn-sm btn-secondary" href="{{ action('ReportController@show', ['id' => $report->id]) }}">View</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $closedReports->links('vendor.pagination.bootstrap-4'); !!}
                    </div>
                </div>

                <div class="card-footer text-right">
                @if (url()->current() == "/dashboard")
                  <a href="" class="btn btn-sm btn-secondary">View All</a>
                @else
                  <a href="{{ route('dashboard') }}" class="btn btn-sm btn-secondary">Back to Dashboard</a>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('shared.modal-alert')
@endsection
