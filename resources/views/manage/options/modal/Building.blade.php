
<div class="card">
    <div class="card-header">
        <div class="row header">
            <div class="col-md-6">Building</div>
            <div class="col-md-2">Actions</div>
        </div>
    </div>
    <div class="card-body">
        <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>
        <div class="alert alert-success print-success-msg" style="display:none"></div>
        @foreach($fields['building'] as $building)
            <div class="row">
                <div class="col-md-6">
                    <input data-id="{{ $building->id }}" class="form-control" type="text" name="building-{{ $building->id }}" value="{{ $building->name }}" >
                </div>
                <div class="col-md-1">
                    <button data-id="{{ $building->id }}" type="button" class="btn btn-default btn-sm update-building" aria-label="Save">
                        <span class="fa fa-save" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="col-md-1">
                    <button data-id="{{ $building->id }}" type="button" class="btn btn-default btn-sm delete-building" aria-label="Delete">
                        <span class="fa fa-trash-o" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        @endforeach
        <div class="row no-show" id="placeholder-building" style="display: none;">
            <div class="col-md-6">
                <input class="form-control" type="text" name="building" placeholder="Enter new Building" >
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-default btn-sm create-building" aria-label="Save">
                    <span class="fa fa-save" aria-hidden="true"></span>
                </button>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-default btn-sm remove-building" aria-label="Delete">
                    <span class="fa fa-trash-o" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button id="new-building" type="button" class="btn btn-secondary" aria-label="New">
            <span class="fa fa-plus" aria-hidden="true"></span>
        </button>
    </div>
</div>
