import ManageOptions from './ManageOptions.es6';

new class Building extends ManageOptions {

    constructor() {
        super();
        this.debug ? console.debug('Building loaded, debugging turned on.') : '';
        this.bindEventsBuilding();
    }

    bindEventsBuilding() {
        $('#modal-body').on('click', '.update-building', (e) => {
            this.debug ? console.debug('Update option button clicked.') : '';
            this.updateBuilding(e);
        });

        $('#modal-body').on('click', '.create-building', (e) => {
            this.debug ? console.debug('Create building button clicked.') : '';
            this.createBuilding(e);
        });

        $('#modal-body').on('click', '.remove-building', (e) => {
            this.debug ? console.debug('Create building button clicked.') : '';
            this.removeBuilding(e);
        });

        $('#modal-body').on('click', '.delete-building', (e) => {
            this.debug ? console.debug('Delete building button clicked.') : '';
            this.deleteBuildingConfirm(e);
        });

        $('#modal-body').on('click', '#new-building', () => {
            this.debug ? console.debug('Add building button clicked.') : '';
            this.addBuilding();
        });
    }

    updateBuilding(e) {
        let buildingId = $(e.currentTarget).data('id');
        let buildingName = $('input[name="building-' + buildingId + '"]').val();
        let button = $('button.update-building[data-id="' + buildingId + '"]');

        this.debug ? console.debug('buildingId: ', buildingId) : '';
        this.debug ? console.debug('buildingName: ', buildingName) : '';

        $.ajax({
            url: "/manage/options/building/update/" + buildingId,
            method: 'POST',
            data: {
                building_id: buildingId,
                building_name: buildingName,
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

    createBuilding(e) {
        let $button = $(e.currentTarget);
        let $dataId = $button.data('id');
        this.debug ? console.debug('clicked element: ', $button) : '';
        let buildingName = $('input[name=building][data-id=' + $dataId + ']').val();
        this.debug ? console.debug('buildingName: ', buildingName) : '';

        $.ajax({
            url: "/manage/options/building/store",
            method: 'POST',
            data: {
                building_name: buildingName,
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

    deleteBuildingConfirm(e) {
        this.debug ? console.debug('deleteBuildingConfirm called. e: ', $(e.currentTarget)) : '';
        let $target = $("input[name='option_id']");
        let $targetId = $(e.currentTarget).data('id');
        this.debug ? console.debug('option id: ', $targetId) : '';
        $target.val($targetId);
        $('input[name="field_name"]').val('building');
        $('#confirm-delete-option').modal('show');
        $('#delete-option').on('click', () => {
            this.deleteBuilding(e);
        });
    }

    deleteBuilding(e) {
        let buildingId = $(e.currentTarget).data('id');
        let button = $('button.delete-building[data-id="' + buildingId + '"]');
        this.debug ? console.debug('buildingId: ', buildingId) : '';
        $('#confirm-delete-option').modal('hide');

        $.ajax({
            url: "/manage/options/building/delete/" + buildingId,
            method: 'POST',
            data: {
                building_id: buildingId,
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

    addBuilding(e) {
        this.debug ? console.debug('Add Building option clicked.') : '';
        let $target = $('#placeholder-building');
        let $parent = $target.parent();
        let $count = $(".no-show").length;
        let $newrow = $target.clone().appendTo($parent);

        $newrow.attr('id', 'placeholder-building-' + $count);
        $newrow.find('button, input').attr('data-id', $count);
        $newrow.removeAttr('style');
    }

    removeBuilding(e) {
        this.debug ? console.debug('Remove Building option clicked.') : '';
        $(e.currentTarget).closest('.row').remove();
    }

};