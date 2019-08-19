@extends('layouts.app')

@section('content')
    <div class="container center">
        <div class="row">
            <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success save-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

                <form method="post" action="{{ action('BuildingController@update', ['id' => $data['building']['id']]) }}">
                    {{ csrf_field() }}
                    <div class="card mb-5">
                        <div class="card-header">
                            <h1>Edit Building</h1>
                        </div>

                        <div class="card-body">
                            <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>
                            <div class="alert alert-success print-success-msg" style="display:none"></div>
                            
                            <div class="form-group">
                                <div class="row">
                                    <label for="name" class="col-md-4 control-label">Name</label>
                                    <input class="form-control col-md-6" type="text" name="name" id="name" value="{{ $data['building']['name'] }}" />
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <h2>Rooms</h2>
                        </div>

                        <div class="card-body">

                            @foreach($data['rooms'] as $room)
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="room[{{ $room->id }}]" id="room-{{ $room->id }}" value="{{ $room->name }}" />
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <div class="form-group">
                                <div class="row" id="placeholder-room" style="display: none;">
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="newroom[]" placeholder="Enter new Room">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="text-left col-md-4">
                                    <button id="new-room" type="button" class="btn btn-secondary" aria-label="New">
                                        Add Room
                                    </button>
                                </div>
                                <div class="text-right col-md-8">
                                    <button type="submit" class="btn btn-primary" aria-label="Save" value="Save">Save</button>
                                    <a href="{{ action('BuildingController@index') }}" class="btn btn-secondary" aria-label="Cancel">Cancel</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
