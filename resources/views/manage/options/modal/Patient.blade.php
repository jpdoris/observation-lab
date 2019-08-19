
<div class="card">
    <div class="card-header">
        <div class="row header">
            <div class="col-md-6">Patient Name</div>
            <div class="col-md-2">Actions</div>
        </div>
    </div>
    <div class="card-body">
        <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>
        <div class="alert alert-success print-success-msg" style="display:none"></div>
        @foreach($fields['patient'] as $patient)
            <div class="row">
                <div class="col-md-6">
                    <input data-id="{{ $patient->id }}" class="form-control" type="text" name="patient-{{ $patient->id }}" value="{{ $patient->name }}" >
                </div>
                <div class="col-md-1">
                    <button data-id="{{ $patient->id }}" type="button" class="btn btn-default btn-sm update-patient" aria-label="Save">
                        <span class="fa fa-save" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="col-md-1">
                    <button data-id="{{ $patient->id }}" type="button" class="btn btn-default btn-sm delete-patient" aria-label="Delete">
                        <span class="fa fa-trash-o" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        @endforeach
        <div class="row no-show" id="placeholder-patient" style="display: none;">
            <div class="col-md-6">
                <input class="form-control" type="text" name="patient" placeholder="Enter new Patient" >
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-default btn-sm create-patient" aria-label="Save">
                    <span class="fa fa-save" aria-hidden="true"></span>
                </button>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-default btn-sm remove-patient" aria-label="Delete">
                    <span class="fa fa-trash-o" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button id="new-patient" type="button" class="btn btn-secondary" aria-label="Add">
            <span class="fa fa-plus" aria-hidden="true"></span>
        </button>
    </div>
</div>
