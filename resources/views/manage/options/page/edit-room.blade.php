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

                <form class="form-horizontal" method="post" action="{{ action('BuildingController@updateRoom', ['id' => $id]) }}">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header">
                            <h2 class="row header">Edit Room</h2>
                        </div>

                        <div class="card-body">
                            <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>
                            <div class="alert alert-success print-success-msg" style="display:none"></div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="date" class="col-md-4 control-label">ID</label>
                                    <input class="form-control-plaintext col-md-6" type="text" name="id" id="id" value="{{ $room->id }}" readonly />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="name" class="col-md-4 control-label">Name</label>
                                    <input class="form-control col-md-6" type="text" name="name" id="name" value="{{ $room->name }}" />
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary" aria-label="Save" value="Save">Save</button>
                                    <a href="{{ URL::previous() }}" class="btn btn-secondary" aria-label="Cancel">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="previous_url" value="{{ URL::previous() }}" />
                </form>
            </div>
        </div>
    </div>
@endsection