import ManageOptions from './ManageOptions.es6';

new class AnimalType extends ManageOptions {

    constructor() {
        super();
        this.debug ? console.debug('AnimalType loaded, debugging turned on.') : '';
        this.bindEventsAnimalType();
    }

    bindEventsAnimalType() {
        $('#modal-body').on('click', '.update-animaltype', (e) => {
            this.debug ? console.debug('Update option button clicked.') : '';
            this.updateAnimalType(e);
        });

        $('#modal-body').on('click', '.create-animaltype', (e) => {
            this.debug ? console.debug('Create animaltype button clicked.') : '';
            this.createAnimalType(e);
        });

        $('#modal-body').on('click', '.remove-animaltype', (e) => {
            this.debug ? console.debug('Create animaltype button clicked.') : '';
            this.removeAnimalType(e);
        });

        $('#modal-body').on('click', '.delete-animaltype', (e) => {
            this.debug ? console.debug('Delete animaltype button clicked.') : '';
            this.deleteAnimalTypeConfirm(e);
        });

        $('#modal-body').on('click', '#new-animaltype', () => {
            this.debug ? console.debug('Add animaltype button clicked.') : '';
            this.addAnimalType();
        });
    }

    updateAnimalType(e) {
        let animaltypeId = $(e.currentTarget).data('id');
        let animaltypeName = $('input[name="animaltype-' + animaltypeId + '"]').val();
        let button = $('button.update-animaltype[data-id="' + animaltypeId + '"]');

        this.debug ? console.debug('animaltypeId: ', animaltypeId) : '';
        this.debug ? console.debug('animaltypeName: ', animaltypeName) : '';

        $.ajax({
            url: "/manage/options/animaltype/update/" + animaltypeId,
            method: 'POST',
            data: {
                animaltype_id: animaltypeId,
                animaltype_name: animaltypeName,
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

    createAnimalType(e) {
        let $button = $(e.currentTarget);
        let $dataId = $button.data('id');
        this.debug ? console.debug('clicked element: ', $button) : '';
        let animaltypeName = $('input[name=animaltype][data-id=' + $dataId + ']').val();
        this.debug ? console.debug('animaltypeName: ', animaltypeName) : '';

        $.ajax({
            url: "/manage/options/animaltype/store",
            method: 'POST',
            data: {
                animaltype_name: animaltypeName,
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

    deleteAnimalTypeConfirm(e) {
        this.debug ? console.debug('deleteAnimalTypeConfirm called. e: ', $(e.currentTarget)) : '';
        let $target = $("input[name='option_id']");
        let $targetId = $(e.currentTarget).data('id');
        this.debug ? console.debug('option id: ', $targetId) : '';
        $target.val($targetId);
        $('input[name="field_name"]').val('animaltype');
        $('#confirm-delete-option').modal('show');
        $('#delete-option').on('click', () => {
            this.deleteAnimalType(e);
        });
    }

    deleteAnimalType(e) {
        let animaltypeId = $(e.currentTarget).data('id');
        let button = $('button.delete-animaltype[data-id="' + animaltypeId + '"]');
        this.debug ? console.debug('animaltypeId: ', animaltypeId) : '';
        $('#confirm-delete-option').modal('hide');

        $.ajax({
            url: "/manage/options/animaltype/delete/" + animaltypeId,
            method: 'POST',
            data: {
                animaltype_id: animaltypeId,
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

    addAnimalType(e) {
        this.debug ? console.debug('Add AnimalType option clicked.') : '';
        let $target = $('#placeholder-animaltype');
        let $parent = $target.parent();
        let $count = $(".no-show").length;
        let $newrow = $target.clone().appendTo($parent);

        $newrow.attr('id', 'placeholder-animaltype-' + $count);
        $newrow.find('button, input').attr('data-id', $count);
        $newrow.removeAttr('style');
    }

    removeAnimalType(e) {
        this.debug ? console.debug('Remove AnimalType clicked.') : '';
        $(e.currentTarget).closest('.row').remove();
    }

};