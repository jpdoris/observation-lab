import ManageOptions from './ManageOptions.es6';

new class AnimalSubtype extends ManageOptions {

    constructor() {
        super();
        this.debug ? console.debug('AnimalSubtype loaded, debugging turned on.') : '';
        this.bindEventsAnimalSubtype();
    }

    bindEventsAnimalSubtype() {
        $('#modal-body').on('click', '.update-animalsubtype', (e) => {
            this.debug ? console.debug('Update animalsubtype button clicked.') : '';
            this.updateAnimalSubtype(e);
        });

        $('#modal-body').on('click', '.create-animalsubtype', (e) => {
            this.debug ? console.debug('Create animalsubtype button clicked.') : '';
            this.createAnimalSubtype(e);
        });

        $('#modal-body').on('click', '.remove-animalsubtype', (e) => {
            this.debug ? console.debug('Create animalsubtype button clicked.') : '';
            this.removeAnimalSubtype(e);
        });

        $('#modal-body').on('click', '.delete-animalsubtype', (e) => {
            this.debug ? console.debug('Delete animalsubtype button clicked.') : '';
            this.deleteAnimalSubtypeConfirm(e);
        });

        $('#modal-body').on('click', '#new-animalsubtype', () => {
            this.debug ? console.debug('Add animalsubtype button clicked.') : '';
            this.addAnimalSubtype();
        });
    }

    updateAnimalSubtype(e) {
        let animalSubtypeId = $(e.currentTarget).data('id');
        let animalSubtypeName = $('input[name="animalsubtype-' + animalSubtypeId + '"]').val();
        let animalTypeId = $('input[name="animaltype-' + animalSubtypeId + '"]:checked').val();
        let button = $('button.update-animalsubtype[data-id="' + animalSubtypeId + '"]');

        this.debug ? console.debug('animalSubtypeId: ', animalSubtypeId) : '';
        this.debug ? console.debug('animalSubtypeName: ', animalSubtypeName) : '';
        this.debug ? console.debug('animalTypeId: ', animalTypeId) : '';

        $.ajax({
            url: "/manage/options/animalsubtype/update/" + animalSubtypeId,
            method: 'POST',
            data: {
                animal_subtype_id: animalSubtypeId,
                animal_subtype_name: animalSubtypeName,
                animal_type_id: animalTypeId,
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

    createAnimalSubtype(e) {
        let $button = $(e.currentTarget);
        let $dataId = $button.data('id');
        this.debug ? console.debug('clicked element: ', $button) : '';

        let animalSubtypeName = $('input[name=animalsubtype][data-id=' + $dataId + ']').val();
        let animalTypeId = $('input[name=animaltype][data-id=' + $dataId + ']:checked').val();
        this.debug ? console.debug('animalSubtypeName: ', animalSubtypeName) : '';
        this.debug ? console.debug('animalTypeId: ', animalTypeId) : '';

        $.ajax({
            url: "/manage/options/animalsubtype/store",
            method: 'POST',
            data: {
                animal_subtype_name: animalSubtypeName,
                animal_type_id: animalTypeId,
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

    deleteAnimalSubtypeConfirm(e) {
        this.debug ? console.debug('deleteAnimalSubtypeConfirm called. e: ', $(e.currentTarget)) : '';
        let $target = $("input[name='option_id']");
        let $targetId = $(e.currentTarget).data('id');
        this.debug ? console.debug('option id: ', $targetId) : '';
        $target.val($targetId);
        $('input[name="field_name"]').val('animalsubtype');
        $('#confirm-delete-option').modal('show');
        $('#delete-option').on('click', () => {
            this.deleteAnimalSubtype(e);
        });
    }

    deleteAnimalSubtype(e) {
        let animalSubtypeId = $(e.currentTarget).data('id');
        let button = $('button.delete-animalsubtype[data-id="' + animalSubtypeId + '"]');
        this.debug ? console.debug('animalSubtypeId: ', animalSubtypeId) : '';
        $('#confirm-delete-option').modal('hide');

        $.ajax({
            url: "/manage/options/animalsubtype/delete/" + animalSubtypeId,
            method: 'POST',
            data: {
                animal_subtype_id: animalSubtypeId,
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

    addAnimalSubtype() {
        this.debug ? console.debug('New animalsubtype clicked.') : '';
        let $target = $('#placeholder-animalsubtype');
        let $parent = $target.parent();
        let $count = $(".no-show").length;
        let $newrow = $target.clone().appendTo($parent);

        $newrow.attr('id', 'placeholder-animalsubtype-' + $count);
        $newrow.find('button, input').attr('data-id', $count);
        $newrow.find('input[name=animaltype]').each( function(el) {
            $(this).attr('id', 'animaltype-new-' + $count + '-' + $(this).val());
            $(this).next('label').attr('for', 'animaltype-new-' + $count + '-' + $(this).val());
        });
        $newrow.removeAttr('style');
    }

    removeAnimalSubtype(e) {
        this.debug ? console.debug('Remove animalsubtype clicked.') : '';
        $(e.currentTarget).closest('.row').remove();
    }

};