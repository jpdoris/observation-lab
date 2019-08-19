@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <h1>Update Report</h1>
                    </div>

                    <div class="card-body">
                      <form class="form-horizontal" method="POST" action="{{ action('ReportController@update', ['id' => $id]) }}">
                          {{ csrf_field() }}
                          @include('report.form')
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
