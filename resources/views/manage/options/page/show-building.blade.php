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

                <div class="card">
                    <div class="card-header">
                        <h1>Buildings</h1>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>
                        <div class="alert alert-success print-success-msg" style="display:none"></div>

                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($buildings as $building)
                                    <tr>
                                        <td>{{ $building->id }}</td>
                                        <td><a href="{{ action('BuildingController@edit', ['id' => $building->id]) }}">{{ $building->name }}</a></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                <tr class="no-show" id="placeholder-building" style="display: none;">
                                    <td></td>
                                    <td>
                                        <input class="form-control" type="text" name="building" placeholder="Enter new Building" >
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default btn-sm create-building" aria-label="Save">
                                            <span class="fa fa-save" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="text-left col-md-6">
                                <button id="new-building" type="button" class="btn btn-secondary" aria-label="New">
                                    <span class="fa fa-plus" aria-hidden="true"></span>
                                </button>
                            </div>
                            <div class="text-right col-md-6">
                                <a href="{{ route('manage.options.index') }}" class="btn btn-secondary" aria-label="Back to Options Management" value="Cancel">Cancel</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
