@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading mt-2 mb-4"><h4>Edit Option</h4></div>

                    <div class="panel-body">
                        <div class="container" id="modal-body">
                            <form class="form-horizontal">
                                {{ csrf_field() }}
                                @include('manage.options.modal.' . $field)
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('manage.options.modal-confirm-delete')
@endsection