import ManageOptions from './ManageOptions.es6';

new class Study extends ManageOptions {

    constructor() {
        super();
        this.debug ? console.debug('Study loaded, debugging turned on.') : '';
        this.bindEventsStudy();
    }

    bindEventsStudy() {
        $('#modal-body').on('click', '.update-study', (e) => {
            this.debug ? console.debug('Update option button clicked.') : '';
            this.updateStudy(e);
        });

        $('#modal-body').on('click', '.create-study', (e) => {
            this.debug ? console.debug('Create study button clicked.') : '';
            this.createStudy(e);
        });

        $('#modal-body').on('click', '.remove-study', (e) => {
            this.debug ? console.debug('Create study button clicked.') : '';
            this.removeStudy(e);
        });

        $('#modal-body').on('click', '.delete-study', (e) => {
            this.debug ? console.debug('Delete study button clicked.') : '';
            this.deleteStudyConfirm(e);
        });

        $('#modal-body').on('click', '#new-study', () => {
            this.debug ? console.debug('Add study button clicked.') : '';
            this.addStudy();
        });
    }

    updateStudy(e) {
        let studyId = $(e.currentTarget).data('id');
        let studyName = $('input[name="study-' + studyId + '"]').val();
        let button = $('button.update-study[data-id="' + studyId + '"]');

        this.debug ? console.debug('studyId: ', studyId) : '';
        this.debug ? console.debug('studyName: ', studyName) : '';

        $.ajax({
            url: "/manage/options/study/update/" + studyId,
            method: 'POST',
            data: {
                study_id: studyId,
                study_name: studyName,
                _token: this.token,
            },
            beforeSend: super.showSpinner(button, 'save'),
            success: (data) => {
                this.debug ? console.debug('ajax response: ', data) : '';
                super.hideSpinner(button, 'save');
                if (!$.isEmptyObject(data.error)) {
                    super.printErrorMsg(data.error);
                } else {
                    super.printSuccessMsg(data.success);
                }
            },
        });
    }

    createStudy(e) {
        let $button = $(e.currentTarget);
        let $dataId = $button.data('id');
        this.debug ? console.debug('clicked element: ', $button) : '';
        let studyName = $('input[name=study][data-id=' + $dataId + ']').val();
        this.debug ? console.debug('studyName: ', studyName) : '';

        $.ajax({
            url: "/manage/options/study/store",
            method: 'POST',
            data: {
                study_name: studyName,
                _token: this.token,
            },
            beforeSend: super.showSpinner($button, 'save'),
            success: (data) => {
                this.debug ? console.debug('ajax response: ', data) : '';
                super.hideSpinner($button, 'save');
                if (!$.isEmptyObject(data.error)) {
                    super.printErrorMsg(data.error);
                } else {
                    super.printSuccessMsg(data.success);
                }
            },
        });
    }

    deleteStudyConfirm(e) {
        this.debug ? console.debug('deleteStudyConfirm called. e: ', $(e.currentTarget)) : '';
        let $target = $("input[name='option_id']");
        let $targetId = $(e.currentTarget).data('id');
        this.debug ? console.debug('option id: ', $targetId) : '';
        $target.val($targetId);
        $('input[name="field_name"]').val('study');
        $('#confirm-delete-option').modal('show');
        $('#delete-option').on('click', () => {
            this.deleteStudy(e);
        });
    }

    deleteStudy(e) {
        let studyId = $(e.currentTarget).data('id');
        let button = $('button.delete-study[data-id="' + studyId + '"]');
        this.debug ? console.debug('studyId: ', studyId) : '';
        $('#confirm-delete-option').modal('hide');

        $.ajax({
            url: "/manage/options/study/delete/" + studyId,
            method: 'POST',
            data: {
                study_id: studyId,
                _token: this.token,
            },
            beforeSend: super.showSpinner(button, 'trash'),
            success: (data) => {
                this.debug ? console.debug('ajax response: ', data) : '';
                super.hideSpinner(button, 'trash');
                if (!$.isEmptyObject(data.error)) {
                    super.printErrorMsg(data.error);
                } else {
                    $(e.currentTarget).closest('.row').remove();
                    super.printSuccessMsg(data.success);
                }
            },
        });
    }

    addStudy(e) {
        this.debug ? console.debug('Add Study option clicked.') : '';
        let $target = $('#placeholder-study');
        let $parent = $target.parent();
        let $count = $(".no-show").length;
        let $newrow = $target.clone().appendTo($parent);

        $newrow.attr('id', 'placeholder-study-' + $count);
        $newrow.find('button, input').attr('data-id', $count);
        $newrow.removeAttr('style');
    }

    removeStudy(e) {
        this.debug ? console.debug('Remove Study clicked.') : '';
        $(e.currentTarget).closest('.row').remove();
    }

};