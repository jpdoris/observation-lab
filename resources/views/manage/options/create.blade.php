@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading mt-2 mb-4"><h4>{Header Here}</h4></div>

                    <div class="panel-body">
                        <div class="container">
                            <form class="form-horizontal" method="post" action="{{ action('OptionsController@create') }}">
                                {{ csrf_field() }}
                                @include('manage.options.form')
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection