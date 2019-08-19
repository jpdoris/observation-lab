@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Close-out</h4>
                    </div>

                    <div class="card-body">
                        <div class="border-bottom mb-5 pb-3">
                            @include('report.detail')
                        </div>

                        @include('report.history')

                        <form class="form-horizontal" method="POST" action="{{ action('CloseoutController@create', ['id' => $report_id]) }}">
                            {{ csrf_field() }}
                            @include('closeout.form')
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection