<div class="modal fade in" id="modal-empty" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="dialog">
        <div class="modal-content">
            <div class="modal-header alert alert-heading alert-primary">
                <h5 class="modal-title" id="fieldname"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-body" id="modal-body"></div>

                {{-- <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" name="option-save" value="Save" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> --}}

            </form>
        </div>
    </div>
</div>
