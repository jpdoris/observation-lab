
                    <div class="card">
                        <div class="card-header">
                            <div class="row header">
                                <div class="col-md-6">Concern Location</div>
                                <div class="col-md-4">Concern Quality</div>
                                <div class="col-md-2">Actions</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>
                            <div class="alert alert-success print-success-msg" style="display:none"></div>
                        @foreach($fields['concernlocation'] as $location)
                            <div class="row">
                                <div class="col-md-6">
                                    <input data-id="{{ $location->id }}" class="form-control" type="text" name="concernlocation-{{ $location->id }}" value="{{ $location->name }}" >
                                </div>
                                <div class="col-md-4">
                                    <button data-id="{{ $location->id }}" type="button" class="btn btn-default btn-sm select-location" aria-label="Edit">
                                        <span class="fa fa-edit" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="col-md-1">
                                    <button data-id="{{ $location->id }}" type="button" class="btn btn-default btn-sm update-location" aria-label="Save">
                                        <span class="fa fa-save" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="col-md-1">
                                    <button data-id="{{ $location->id }}" type="button" class="btn btn-default btn-sm delete-location" aria-label="Delete">
                                        <span class="fa fa-trash-o" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                            <div class="row no-show" id="placeholder-concernlocation" style="display: none;">
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="concernlocation" placeholder="Enter new Concern Location" >
                                </div>
                                <div class="col-md-4">
                                    <button data-id="" type="button" class="btn btn-default btn-sm select-location" aria-label="Edit">
                                        <span class="fa fa-edit" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-default btn-sm create-location" aria-label="Save">
                                        <span class="fa fa-save" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-default btn-sm remove-location" aria-label="Delete">
                                        <span class="fa fa-trash-o" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="new-concernlocation" type="button" class="btn btn-secondary" aria-label="New">
                                <span class="fa fa-plus" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
