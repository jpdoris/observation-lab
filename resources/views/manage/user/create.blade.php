@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <h1>Create a User</h1>
                    </div>

                    <div class="card-body">
                      <form class="form-horizontal" method="post" action="{{ action('UserController@create') }}">
                          {{ csrf_field() }}
                          @include('manage.user.form')
                      </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
