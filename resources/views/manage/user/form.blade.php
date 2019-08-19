@include('shared.alerts')

                        <div class="form-group row">
                          <label for="email" class="col-md-2 col-form-label">Email</label>
                          <div class="col-md-10">
                            <input type="text" class="form-control" name="email" id="email" value="{{ ('' != old('email')) ? old('email') : (isset($user->email) ? $user->email : '') }}" />
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="first_name" class="col-md-2 col-form-label">First Name</label>
                          <div class="col-md-10">
                            <input type="text" class="form-control" name="first_name" id="first_name" value="{{ ('' != old('first_name')) ? old('first_name') : (isset($user->first_name) ? $user->first_name : '') }}" />
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="last_name" class="col-md-2 col-form-label">Last Name</label>
                          <div class="col-md-10">
                            <input type="text" class="form-control" name="last_name" id="last_name" value="{{ ('' != old('last_name')) ? old('last_name') : (isset($user->last_name) ? $user->last_name : '') }}" />
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="password" class="col-md-2 col-form-label">Password</label>
                          <div class="col-md-10">
                            <input type="password" class="form-control" name="password" id="password" value="" />
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="password_confirmation" class="col-md-2 col-form-label">Confirm Password</label>
                          <div class="col-md-10">
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="" />
                          </div>
                        </div>

                        <div class="form-group{{ $errors->has('group_id') ? ' is-invalid' : '' }} row">
                            <label for="group_id" class="col-md-2 col-form-label">Group</label>
                            <div class="col-md-10">
                                <select class="custom-select" name="group_id" id="group_id">
                                    <option value="0">Select...</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group->id }}" @if($group->id == old('group_id') || $group->id == $user->group_id) selected="selected" @endif>{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-legend col-md-2">Role</label>
                            <div class="col-md-10">
                                @foreach($roles as $role)
                                <div class="form-check">
                                    <label class="form-check-label col-form-label">
                                        <input class="form-check-input" type="checkbox" name="role_id[]" value="{{ $role->id }}" @if($id && ($role->id == old('role_id') || array_key_exists($role->id, $user->getRoles()))) checked @endif>
                                        {{ $role->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-2 mx-auto">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-primary" value="Save">
                                    <a href="{{ route('manage.user.index') }}" id="cancel" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </div>
