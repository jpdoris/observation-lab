@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="card">
                    <div class="card-header">
                      <h1>Report Details</h1>
                    </div>

                    <div class="card-body">

                        <div class="container">
                            @include('report.detail')
                        </div>

                        <div class="container">
                            @include('report.history')
                        </div>

                    </div>

                    <div class="card-footer text-right">
                      <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
