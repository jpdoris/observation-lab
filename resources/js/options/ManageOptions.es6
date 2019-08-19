const $ = jQuery;

export default class ManageOptions {

    constructor() {
        this.token = $("input[name='_token']").val();
        this.hash = window.location.hash.substr(1);
        this.debug = (this.hash == 'debug') ? true : false;
        this.bindEvents();
    }

    bindEvents() {

        $('.stacked').on('hidden.bs.modal', () => {
            this.closeStackedModal();
        });
        $('.stacked').on('show.bs.modal', () => {
            this.openStackedModal();
        });

        // listen for modal open click event, and populate the empty modal template
        $('.options-open').off().on('click', (e) => {
            let $field = $(e.currentTarget).data('name');
            let $label = $.trim($(e.currentTarget).html());
            this.showGenericSpinner($(e.currentTarget));
            $('#modal-body').load('/manage/options/show/' + $field, () => {
                this.debug ? console.debug('Open ' + $field + ' modal clicked.') : '';
                $('#fieldname').html($label);
                $('#modal-empty').modal({show:true});
                this.hideGenericSpinner($(e.currentTarget));
                $field = '';
                $label = '';
            });
        });
    }


    showMessage(title, msg) {
        this.debug ? console.debug('showMessage called. Selected ID: ', typeof $('.row-selected').data('id')) : '';
        $('#modal-title').html(title);
        $('#message').html(msg);
        $('#modal-alert').modal('show');
    }

    showSpinner(target, icon="save") {
        this.debug ? console.debug('spinner on') : '';
        this.debug ? console.debug('target: ', target) : '';
        $(target).find('span').removeClass('fa-' + icon);
        $(target).find('span').addClass('fa-spinner fa-spin');
    }

    hideSpinner(target, icon="save") {
        this.debug ? console.debug('spinner off') : '';
        $(target).find('span').removeClass('fa-spinner fa-spin');
        $(target).find('span').addClass('fa-' + icon);
    }


    showGenericSpinner(target) {
        this.debug ? console.debug('spinner on') : '';
        this.debug ? console.debug('target: ', target) : '';
        $(target).css('opacity', '.50');
        $(target).addClass('spinner-save');
    }

    hideGenericSpinner(target) {
        this.debug ? console.debug('spinner off') : '';
        $(target).removeClass('spinner-save');
        $(target).css('opacity', '1');
    }

    printErrorMsg (msg) {
        this.debug ? console.debug('printErrorMsg called.') : '';
        $(".print-success-msg").html('');
        $(".print-success-msg").css('display', 'none');
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        let $isArray = $.isArray(msg);
        if ($isArray) {
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        } else {
            $(".print-error-msg").find("ul").append('<li>' + msg + '</li>');
        }
    }

    printSuccessMsg(msg) {
        this.debug ? console.debug('printSuccessMsg called. ', msg) : '';
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'none');
        $(".print-success-msg").html('');
        $(".print-success-msg").css('display','block');
        $(".print-success-msg").html(msg);
    }

    openStackedModal() {
        this.debug ? console.debug('openStackedModal called.') : '';
        this.fixOverflow();
        $('#modal-empty').css('opacity', '0.5');
        $('#modal-empty').addClass('modal-backdrop');
    }

    closeStackedModal() {
        this.debug ? console.debug('closeStackedModal called.') : '';
        this.fixOverflow();
        $('#modal-empty').css('opacity', '1');
        $('#modal-empty').removeClass('modal-backdrop');
    }

    fixZindex(event) {
        this.debug ? console.debug('z-index hack triggered.','event',event.currentTarget) : '';
        let zIndex = 1040 + (10 * $('.modal:visible').length);
        $(event.currentTarget).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    }

    fixOverflow() {
        $('.modal').css('overflow-y', 'auto');
    }
};