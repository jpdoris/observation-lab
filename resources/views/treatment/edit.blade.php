@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Treatment</h4></div>

                    <div class="panel-body">

                        <div class="container">
                            <form class="form-horizontal" method="POST" action="{{ action('TreatmentController@update', ['id' => $id]) }}">
                                @include('report.detail')
                                {{ csrf_field() }}
                                @include('treatment.form')
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection