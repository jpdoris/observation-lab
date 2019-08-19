@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Options Management</h1>
                    </div>

                    <div class="card-body">

                        @include('shared.alerts')

                        <div class="row">
                            <div class="btn-group-vertical col-md-6">
                                <button type="button" class="btn btn-primary m-3 options-open" data-name="AnimalType">
                                    Animal Types
                                </button>
                                <button type="button" class="btn btn-primary m-3 options-open" data-name="ConcernQuality">
                                    Concern Qualities
                                </button>
                                <button type="button" class="btn btn-primary m-3 options-open" data-name="Patient">
                                    Patients
                                </button>
                            </div>

                            <div class="btn-group-vertical col-md-6">
                                <button type="button" class="btn btn-primary m-3 options-open" data-name="AnimalSubtype">
                                    Animal Subtype
                                </button>
                                <button type="button" class="btn btn-primary m-3 options-open" data-name="ConcernLocation">
                                    Concern Locations
                                </button>
                                <a class="btn btn-primary m-3" data-name="Study" href="/manage/options/edit/study">
                                    Studies
                                </a>
                            </div>
                        </div>


                        <div class="row">
                            <div class="btn-group-vertical col-md-6">
                                <a class="btn btn-primary m-3" data-name="Building" href="/manage/options/building/edit">
                                    Buildings and Rooms
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer text-right">
                        <div class="mt-2 mx-auto">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manage.options.modal.empty')
    @include('manage.options.modal.locations-popup')
    @include('manage.options.modal-confirm-delete')
    @include('shared.modal-alert')
@endsection