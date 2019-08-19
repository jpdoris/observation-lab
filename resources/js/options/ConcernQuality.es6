import ManageOptions from './ManageOptions.es6';

new class ConcernQuality extends ManageOptions {

    constructor() {
        super();
        this.debug ? console.debug('ConcernQuality loaded, debugging turned on.') : '';
        this.bindEventsCq();
    }

    bindEventsCq() {
        $('#modal-body').on('click', '.update-cq', (e) => {
            this.debug ? console.debug('Update cq button clicked.') : '';
            this.updateConcernQuality(e);
        });

        $('#modal-body').on('click', '.create-cq', (e) => {
            this.debug ? console.debug('Create cq button clicked.') : '';
            this.createConcernQuality(e);
        });

        $('#modal-body').on('click', '.remove-cq', (e) => {
            this.debug ? console.debug('Create cq button clicked.') : '';
            this.removeConcernQuality(e);
        });

        $('#modal-body').on('click', '.delete-cq', (e) => {
            this.debug ? console.debug('Delete cq button clicked.') : '';
            this.deleteConcernQualityConfirm(e);
        });

        $('#modal-body').on('click', '#new-concernquality', () => {
            this.debug ? console.debug('Add cq button clicked.') : '';
            this.addConcernQuality();
        });
    }

    updateConcernQuality(e) {
        let concernQualityId = $(e.currentTarget).data('id');
        let concernQualityName = $('input[name="concernquality-' + concernQualityId + '"]').val();
        let animalTypeId = $('input[name="animaltype-' + concernQualityId + '"]:checked').map( function() {
            return this.value;
        }).get();
        let button = $('button.update-cq[data-id="' + concernQualityId + '"]');

        this.debug ? console.debug('concernQualityId: ', concernQualityId) : '';
        this.debug ? console.debug('concernQualityName: ', concernQualityName) : '';
        this.debug ? console.debug('animalTypeId: ', animalTypeId) : '';

        $.ajax({
            url: "/manage/options/concernquality/update/" + concernQualityId,
            method: 'POST',
            data: {
                concern_quality_id: concernQualityId,
                concern_quality_name: concernQualityName,
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

    createConcernQuality(e) {
        let $button = $(e.currentTarget);
        let $dataId = $button.data('id');
        this.debug ? console.debug('clicked element: ', $button) : '';

        let concernQualityName = $('input[name=concernquality][data-id=' + $dataId + ']').val();
        let animalTypeId = $('input[name=animaltype][data-id=' + $dataId + ']:checked').map( function() {
            return this.value;
        }).get();
        this.debug ? console.debug('concernQualityName: ', concernQualityName) : '';
        this.debug ? console.debug('animalTypeId: ', animalTypeId) : '';

        $.ajax({
            url: "/manage/options/concernquality/store",
            method: 'POST',
            data: {
                concern_quality_name: concernQualityName,
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

    deleteConcernQualityConfirm(e) {
        this.debug ? console.debug('deleteConcernQualityConfirm called. e: ', $(e.currentTarget)) : '';
        let $target = $("input[name='option_id']");
        let $targetId = $(e.currentTarget).data('id');
        this.debug ? console.debug('option id: ', $targetId) : '';
        $target.val($targetId);
        $('input[name="field_name"]').val('concernquality');
        $('#confirm-delete-option').modal('show');
        $('#delete-option').on('click', () => {
            this.deleteConcernQuality(e);
        });
    }

    deleteConcernQuality(e) {
        let concernQualityId = $(e.currentTarget).data('id');
        let button = $('button.delete-cq[data-id="' + concernQualityId + '"]');
        this.debug ? console.debug('concernQualityId: ', concernQualityId) : '';
        $('#confirm-delete-option').modal('hide');

        $.ajax({
            url: "/manage/options/concernquality/delete/" + concernQualityId,
            method: 'POST',
            data: {
                concern_quality_id: concernQualityId,
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

    addConcernQuality() {
        this.debug ? console.debug('New CQ clicked.') : '';
        let $target = $('#placeholder-concernquality');
        let $parent = $target.parent();
        let $count = $(".no-show").length;
        let $newrow = $target.clone().appendTo($parent);

        $newrow.attr('id', 'placeholder-concernquality-' + $count);
        $newrow.find('button, input').attr('data-id', $count);
        $newrow.find('input[name=animaltype]').each( function(el) {
            $(this).attr('id', 'animaltype-new-' + $count + '-' + $(this).val());
            $(this).next('label').attr('for', 'animaltype-new-' + $count + '-' + $(this).val());
        });
        $newrow.removeAttr('style');
    }

    removeConcernQuality(e) {
        this.debug ? console.debug('Remove CQ clicked.') : '';
        $(e.currentTarget).closest('.row').remove();
    }

};