
<div class="card">
    <div class="card-header">
        <div class="row header">
            <div class="col-md-6">Animal Type</div>
            <div class="col-md-2">Actions</div>
        </div>
    </div>
    <div class="card-body">
        <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>
        <div class="alert alert-success print-success-msg" style="display:none"></div>
        @foreach($fields['animaltype'] as $animaltype)
            <div class="row">
                <div class="col-md-6">
                    <input data-id="{{ $animaltype->id }}" class="form-control" type="text" name="animaltype-{{ $animaltype->id }}" value="{{ $animaltype->name }}" >
                </div>
                <div class="col-md-1">
                    <button data-id="{{ $animaltype->id }}" type="button" class="btn btn-default btn-sm update-animaltype" aria-label="Save">
                        <span class="fa fa-save" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="col-md-1">
                    <button data-id="{{ $animaltype->id }}" type="button" class="btn btn-default btn-sm delete-animaltype" aria-label="Delete">
                        <span class="fa fa-trash-o" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        @endforeach
        <div class="row no-show" id="placeholder-animaltype" style="display: none;">
            <div class="col-md-6">
                <input class="form-control" type="text" name="animaltype" placeholder="Enter new AnimalType" >
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-default btn-sm create-animaltype" aria-label="Save">
                    <span class="fa fa-save" aria-hidden="true"></span>
                </button>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-default btn-sm remove-animaltype" aria-label="Delete">
                    <span class="fa fa-trash-o" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button id="new-animaltype" type="button" class="btn btn-secondary" aria-label="Delete">
            <span class="fa fa-plus" aria-hidden="true"></span>
        </button>
    </div>
</div>
