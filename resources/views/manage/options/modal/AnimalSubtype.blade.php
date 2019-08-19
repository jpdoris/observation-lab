
                    <div class="card">
                        <div class="card-header">
                            <div class="row header">
                                <div class="col-md-6">Animal Subtype</div>
                                <div class="col-md-4">Animal Type</div>
                                <div class="col-md-2">Actions</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>
                            <div class="alert alert-success print-success-msg" style="display:none"></div>
                        @foreach($fields['animalsubtype'] as $subtype)
                            <div class="row">
                                <div class="col-md-6">
                                    <input data-id="{{ $subtype->id }}" class="form-control" type="text" name="animalsubtype-{{ $subtype->id }}" value="{{ $subtype->name }}" >
                                </div>
                                <div class="col-md-4">
                                @foreach($fields['animaltype'] as $type)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input animaltype"
                                               type="radio"
                                               name="animaltype-{{ $subtype->id }}"
                                               data-id="{{ $subtype->id }}"
                                               id="animaltype-{{ $subtype->id }}-{{ $type->id }}"
                                               value="{{ $type->id }}"
                                               @if($subtype->animaltype->id == $type->id) checked @endif>
                                        <label class="form-check-label" for="animaltype-{{ $subtype->id }}-{{ $type->id }}">{{ $type->name }}</label>
                                    </div>
                                @endforeach
                                </div>
                                <div class="col-md-1">
                                    <button data-id="{{ $subtype->id }}" type="button" class="btn btn-default btn-sm update-animalsubtype" aria-label="Save">
                                        <span class="fa fa-save" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="col-md-1">
                                    <button data-id="{{ $subtype->id }}" type="button" class="btn btn-default btn-sm delete-animalsubtype" aria-label="Delete">
                                        <span class="fa fa-trash-o" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                            <div class="row no-show" id="placeholder-animalsubtype" style="display: none;">
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="animalsubtype" placeholder="Enter new Animal Subtype" >
                                </div>
                                <div class="col-md-4">
                                    @foreach($fields['animaltype'] as $type)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input"
                                                   type="radio"
                                                   name="animaltype"
                                                   value="{{ $type->id }}">
                                            <label class="form-check-label" for="animaltype-new-{{ $type->id }}">{{ $type->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-default btn-sm create-animalsubtype" aria-label="Save">
                                        <span class="fa fa-save" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-default btn-sm remove-animalsubtype" aria-label="Delete">
                                        <span class="fa fa-trash-o" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="new-animalsubtype" type="button" class="btn btn-secondary" aria-label="New">
                                <span class="fa fa-plus" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
