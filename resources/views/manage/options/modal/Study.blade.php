
<div class="card">
    <div class="card-header">
        <div class="row header">
            <div class="col-md-6">Study Name</div>
            <div class="col-md-2">Actions</div>
        </div>
    </div>
    <div class="card-body">
        <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>
        <div class="alert alert-success print-success-msg" style="display:none"></div>
        @foreach($fields['study'] as $study)
            <div class="row">
                <div class="col-md-6">
                    <input data-id="{{ $study->id }}" class="form-control" type="text" name="study-{{ $study->id }}" value="{{ $study->name }}" >
                </div>
                <div class="col-md-1">
                    <button data-id="{{ $study->id }}" type="button" class="btn btn-default btn-sm update-study" aria-label="Save">
                        <span class="fa fa-save" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="col-md-1">
                    <button data-id="{{ $study->id }}" type="button" class="btn btn-default btn-sm delete-study" aria-label="Delete">
                        <span class="fa fa-trash-o" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        @endforeach
        <div class="row no-show" id="placeholder-study" style="display: none;">
            <div class="col-md-6">
                <input class="form-control" type="text" name="study" placeholder="Enter new Study" >
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-default btn-sm create-study" aria-label="Save">
                    <span class="fa fa-save" aria-hidden="true"></span>
                </button>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-default btn-sm remove-study" aria-label="Delete">
                    <span class="fa fa-trash-o" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button id="new-study" type="button" class="btn btn-secondary" aria-label="New">
            <span class="fa fa-plus" aria-hidden="true"></span>
        </button>
    </div>
</div>
