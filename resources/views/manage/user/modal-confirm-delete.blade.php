<div class="modal fade in" id="confirm-delete-user" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user?</p>
            </div>
            <div class="modal-footer">
                <form id="form-delete-user" class="form-horizontal" method="post" action="{{ action('UserController@destroy') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" />
                    <input type="submit" class="btn btn-danger" name="confirm-user-delete" value="Delete" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
