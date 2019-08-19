<div class="modal fade in stacked" id="modal-locations" tabindex="1" role="dialog">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-header alert alert-heading alert-primary">
                <h5 class="modal-title" id="location-name"></h5>
                <button type="button" class="close close-quality-location" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-body" id="selected-qualities"></div>

                 <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>
