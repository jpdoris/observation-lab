<div class="modal fade in stacked" id="confirm-delete-option" tabindex="1" role="dialog">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-header alert alert-danger">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this option?</p>
            </div>
            <div class="modal-footer">
                <form id="form-delete-option" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="field_name" />
                    <input type="hidden" name="option_id" />
                    <button type="button" class="btn btn-danger" id="delete-option">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>