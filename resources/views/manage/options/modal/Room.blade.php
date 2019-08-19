
                    <div class="card">
                        <div class="card-header">
                            <div class="row header">
                                <div class="col-md-3">Room</div>
                                <div class="col-md-7">Building</div>
                                <div class="col-md-2">Actions</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>
                            <div class="alert alert-success print-success-msg" style="display:none"></div>
                        @foreach($fields['room'] as $subtype)
                            <div class="row">
                                <div class="col-md-3">
                                    <input data-id="{{ $subtype->id }}" class="form-control" type="text" name="room-{{ $subtype->id }}" value="{{ $subtype->name }}" >
                                </div>
                                <div class="col-md-7">
                                @foreach($fields['building'] as $type)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input building"
                                               type="radio"
                                               name="building-{{ $subtype->id }}"
                                               data-id="{{ $subtype->id }}"
                                               id="building-{{ $subtype->id }}-{{ $type->id }}"
                                               value="{{ $type->id }}"
                                               @if($subtype->building->id == $type->id) checked @endif>
                                        <label class="form-check-label" for="building-{{ $subtype->id }}-{{ $type->id }}">{{ $type->name }}</label>
                                    </div>
                                @endforeach
                                </div>
                                <div class="col-md-1">
                                    <button data-id="{{ $subtype->id }}" type="button" class="btn btn-default btn-sm update-room" aria-label="Save">
                                        <span class="fa fa-save" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="col-md-1">
                                    <button data-id="{{ $subtype->id }}" type="button" class="btn btn-default btn-sm delete-room" aria-label="Delete">
                                        <span class="fa fa-trash-o" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                            <div class="row no-show" id="placeholder-room" style="display: none;">
                                <div class="col-md-3">
                                    <input class="form-control" type="text" name="room" placeholder="Enter new Room" >
                                </div>
                                <div class="col-md-7">
                                    @foreach($fields['building'] as $type)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input"
                                                   type="radio"
                                                   name="building"
                                                   value="{{ $type->id }}">
                                            <label class="form-check-label" for="building-new-{{ $type->id }}">{{ $type->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-default btn-sm create-room" aria-label="Save">
                                        <span class="fa fa-save" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-default btn-sm remove-room" aria-label="Delete">
                                        <span class="fa fa-trash-o" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="new-room" type="button" class="btn btn-secondary" aria-label="New">
                                <span class="fa fa-plus" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
