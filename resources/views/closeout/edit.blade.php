@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Close-Out</h4></div>

                    <div class="panel-body">
                        <div class="container">
                            <form class="form-horizontal" method="POST" action="{{ action('CloseoutController@update', ['id' => $id]) }}">
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