
                    <div class="card">
                        <div class="card-header">
                            <div class="row header">
                                <div class="col-md-6">Quality</div>
                                <div class="col-md-4">Animal Type</div>
                                <div class="col-md-2">Actions</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>
                            <div class="alert alert-success print-success-msg" style="display:none"></div>
                        @foreach($fields['concernquality'] as $quality)
                            <div class="row">
                                <div class="col-md-6">
                                    <input data-id="{{ $quality->id }}" class="form-control" type="text" name="concernquality-{{ $quality->id }}" value="{{ $quality->name }}" >
                                </div>
                                <div class="col-md-4">
                                @foreach($fields['animaltype'] as $type)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input animaltype"
                                               type="checkbox"
                                               name="animaltype-{{ $quality->id }}"
                                               data-id="{{ $quality->id }}"
                                               id="animaltype-{{ $quality->id }}-{{ $type->id }}"
                                               value="{{ $type->id }}"
                                               @if(!empty($quality->animaltype->find($type->id))) checked @endif>
                                        <label class="form-check-label" for="animaltype-{{ $quality->id }}-{{ $type->id }}">{{ $type->name }}</label>
                                    </div>
                                @endforeach
                                </div>
                                <div class="col-md-1">
                                    <button data-id="{{ $quality->id }}" type="button" class="btn btn-default btn-sm update-cq" aria-label="Save">
                                        <span class="fa fa-save" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="col-md-1">
                                    <button data-id="{{ $quality->id }}" type="button" class="btn btn-default btn-sm delete-cq" aria-label="Delete">
                                        <span class="fa fa-trash-o" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                            <div class="row no-show" id="placeholder-concernquality" style="display: none;">
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="concernquality" placeholder="Enter new Concern Quality" >
                                </div>
                                <div class="col-md-4">
                                    @foreach($fields['animaltype'] as $type)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   name="animaltype"
                                                   value="{{ $type->id }}">
                                            <label class="form-check-label" for="animaltype-new-{{ $type->id }}">{{ $type->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-default btn-sm create-cq" aria-label="Save">
                                        <span class="fa fa-save" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-default btn-sm remove-cq" aria-label="Delete">
                                        <span class="fa fa-trash-o" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="new-concernquality" type="button" class="btn btn-secondary" aria-label="New">
                                <span class="fa fa-plus" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
