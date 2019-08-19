$(document).ready(function() {

    var that = this;
    this.token = $("input[name='_token']").val();
    this.hash = window.location.hash.substr(1);
    this.debug = (this.hash == 'debug') ? true : false;

    // fix for stacked modals not handling backdrop correctly
    $(document).on('show.bs.modal', '.modal', function (event) {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });
    $('#confirm-delete-option').on('hidden.bs.modal', function () {
        $('.modal').css('overflow-y', 'auto');
    });

    $('.user-delete').on('click', function (e) {
        that.debug ? console.debug('Delete button clicked.') : '';
        e.preventDefault();
        deleteUserConfirm(e);
    });


    function showMessage(title, msg) {
        that.debug ? console.debug('showMessage called. Selected ID: ', typeof $('.row-selected').data('id')) : '';
        $('#modal-title').html(title);
        $('#message').html(msg);
        $('#modal-alert').modal('show');
    }

    function deleteUserConfirm(e) {
        that.debug ? console.debug('deleteConfirm called. e: ', $(e.currentTarget)) : '';
        var $target = $("input[name='user_id']");
        var $targetId = $(e.currentTarget).data('id');
        that.debug ? console.debug('user id: ', $targetId) : '';
        $target.val($targetId);
        $('#confirm-delete-user').modal('show');
    }

    function showSpinner(target) {
        that.debug ? console.debug('spinner on') : '';
        that.debug ? console.debug('target: ', target) : '';
        $(target).find('span').removeClass('fa-save');
        $(target).find('span').addClass('fa-spinner fa-spin');
    }

    function hideSpinner(target) {
        that.debug ? console.debug('spinner off') : '';
        $(target).find('span').removeClass('fa-spinner fa-spin');
        $(target).find('span').addClass('fa-save');
    }

    function printErrorMsg (msg) {
        that.debug ? console.debug('printErrorMsg called.') : '';
        $(".print-success-msg").html('');
        $(".print-success-msg").css('display', 'none');
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }

    function printSuccessMsg(msg) {
        that.debug ? console.debug('printSuccessMsg called. ', msg) : '';
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'none');
        $(".print-success-msg").html('');
        $(".print-success-msg").css('display','block');
        $(".print-success-msg").html(msg);
    }
});
