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

                <form method="post" action="{{ action('BuildingController@updateRooms', ['id' => $data['building']['id']]) }}">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header">
                            <h2 class="row header">Edit Building Rooms - {{ $data['building']['name'] }}</h2>
                        </div>

                        <div class="card-body">
                            <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>
                            <div class="alert alert-success print-success-msg" style="display:none"></div>
                            <div class="form-group row rooms">
                                <label class="col-form-legend col-md-2">Room</label>
                                <div class="col-md-10 room-block">
                                    @foreach($data['rooms'] as $room)
                                        <div class="form-check">
                                            <label class="form-check-label col-form-label">
                                                <input class="form-check-input"
                                                       type="checkbox"
                                                       name="room_id[]"
                                                       value="{{ $room->id }}"
                                                       @if($room->id == old('room_id') || $room->building_id == $data['building']['id'])) checked @endif>
                                                <a href="{{ action('BuildingController@editRoom', ['id' => $room->id]) }}">{{ $room->name }}</a>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group row no-show" id="placeholder-room" style="display: none;">
                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="room" placeholder="Enter New Room Name" >
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-default btn-sm create-room" aria-label="Save">
                                        <span class="fa fa-save" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="text-left col-md-6">
                                    <button id="new-room" type="button" class="btn btn-secondary" aria-label="New">
                                        <span class="fa fa-plus" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="text-right col-md-6">
                                    <button type="submit" class="btn btn-primary" aria-label="Save" value="Save">Save</button>
                                    <a href="{{ action('BuildingController@edit', ['id' => $data['building']['id']]) }}" class="btn btn-secondary" aria-label="Cancel" value="Cancel">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="building" value="{{ $data['building']['id'] }}" />
                </form>
            </div>
        </div>
    </div>
@endsection