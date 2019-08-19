@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <h1>User Management</h1>
                    </div>

                    <div class="card-body">
                        @include('shared.alerts')

                        <div class="table-responsive">
                          <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th scope="col">User ID</th>
                                  <th scope="col">Last Name</th>
                                  <th scope="col">First Name</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">Role</th>
                                  <th scope="col">Group</th>
                                  <th scope="col"></th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach($users as $user)
                                <tr data-id="{{ $user->id }}" class="table-row-select">
                                  <td>{{ $user->id }}</td>
                                  <td>{{ $user->last_name }}</td>
                                  <td>{{ $user->first_name }}</td>
                                  <td>{{ $user->email }}</td>
                                  <td>@foreach($user->getRoles() as $key => $value)
                                      {{ $value }}
                                      @endforeach</td>
                                  <td>@if($user->group) {{ $user->group->readableName() }} @endif</td>
                                  <td>
                                      <a href="{{ action('UserController@edit', ['id' => $user->id]) }}">Edit</a> |
                                      <a href="#" class="user-delete" data-userid="{{ $user->id }}">Delete</a>
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                      <a href="{{ route('manage.user.create') }}" class="btn btn-primary">Create</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manage.user.modal-confirm-delete')
    @include('shared.modal-alert')
@endsection
