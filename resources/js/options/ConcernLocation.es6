import ManageOptions from './ManageOptions.es6';

new class ConcernLocation extends ManageOptions {

    constructor() {
        super();
        this.debug ? console.debug('ConcernLocation loaded, debugging turned on.') : '';
        this.bindEventsLocation();
    }

    bindEventsLocation() {
        $('#modal-body').on('click', '.select-location', (e) => {
            this.debug ? console.debug('edit location button clicked.') : '';
            this.openLocationOptions(e);
        });

        $('#modal-body').on('click', '.update-location', (e) => {
            this.debug ? console.debug('Update location button clicked.') : '';
            this.updateConcernLocation(e);
        });

        $('#modal-body').on('click', '.create-location', (e) => {
            this.debug ? console.debug('Create location button clicked.') : '';
            this.createConcernLocation(e);
        });

        $('#modal-body').on('click', '.remove-location', (e) => {
            this.debug ? console.debug('Create location button clicked.') : '';
            this.removeConcernLocation(e);
        });

        $('#modal-body').on('click', '.delete-location', (e) => {
            this.debug ? console.debug('Delete location button clicked.') : '';
            this.deleteConcernLocationConfirm(e);
        });

        $('#modal-body').on('click', '#new-concernlocation', () => {
            this.debug ? console.debug('Add location button clicked.') : '';
            this.addConcernLocation();
        });
    }


    openLocationOptions(e) {
        this.debug ? console.debug('openLocationOptions called. e: ', $(e.currentTarget)) : '';
        let $targetId = $(e.currentTarget).data('id');
        let $locationName = $('input[name=concernlocation-' + $targetId + ']').val();
        let $isPopulated = $('input[name=concernquality-' + $targetId + ']').length;
        this.debug ? console.debug('location name: ', $locationName) : '';
        this.debug ? console.debug('option id: ', $targetId) : '';
        this.debug ? console.debug('$isPopulated: ', $isPopulated) : '';
        if ($isPopulated == 0) {
            this.getLocationQualities($targetId, $locationName);
        }
        $('#modal-locations').modal('show');
    }

    getLocationQualities(id, locationName) {
        this.debug ? console.debug('getLocationQualities fired. ') : '';
        this.debug ? console.debug('concernLocationId: ', id) : '';

        let button = $('button.select-location[data-id="' + id + '"]');

        $.ajax({
            url: "/manage/options/concernqualitylocation/get/" + id,
            method: 'POST',
            data: {
                _token: this.token,
            },
            beforeSend: super.showSpinner(button, 'edit'),
            success: (data) => {
                this.debug ? console.debug('ajax response: ', data) : '';
                super.hideSpinner(button, 'edit');
                if (!$.isEmptyObject(data.error)) {
                    super.printErrorMsg(data.error);
                } else {
                    let $checkboxes = '';
                    $('#location-name').html(locationName);
                    $.each(data.name, function(key, value) {
                        $checkboxes += '<div class="form-check form-check-inline">' +
                            '<input class="form-check-input concernquality"' +
                            '       type="checkbox"' +
                            '       name="concernquality-' + id + '"' +
                            '       data-id="' + id + '"' +
                            '       id="concernquality-' + id + '-' + key + '"' +
                            '       value="' + key + '"' + data.checked + '>' +
                            '<label class="form-check-label" for="concernquality-' + id + '-' + key + '">' + value +'</label>' +
                            '</div>';
                    });
                    $('#selected-qualities').html('');
                    $('#selected-qualities').append($checkboxes);
                    $.each(data.checked, function(key, value) {
                        if (value == 'checked') {
                            $('#concernquality-' + id + '-' + key).prop('checked', true);
                        }
                    });
                }
            },
        });
    }

    updateConcernLocation(e) {
        let concernLocationId = $(e.currentTarget).data('id');
        let concernLocationName = $('input[name="concernlocation-' + concernLocationId + '"]').val();
        let concernQualityId = $('input[name="concernquality-' + concernLocationId + '"]:checked').map( function() {
            if (this.value.length === 0) {}
            return this.value;
        }).get();
        let button = $('button.update-location[data-id="' + concernLocationId + '"]');

        this.debug ? console.debug('concernLocationId: ', concernLocationId) : '';
        this.debug ? console.debug('concernLocationName: ', concernLocationName) : '';
        this.debug ? console.debug('concernQualityId: ', concernQualityId) : '';

        $.ajax({
            url: "/manage/options/concernlocation/update/" + concernLocationId,
            method: 'POST',
            data: {
                concern_location_id: concernLocationId,
                concern_location_name: concernLocationName,
                concern_quality_id: concernQualityId,
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

    createConcernLocation(e) {
        this.debug ? console.debug('createConcernLocation called. ') : '';
        let $button = $(e.currentTarget);
        let $dataId = $button.data('id');
        this.debug ? console.debug('clicked element: ', $button) : '';

        let concernLocationName = $('input[name=concernlocation-' + $dataId +'][data-id=' + $dataId + ']').val();
        let concernQualityId = $('input[name=concernquality-' + $dataId +'][data-id=' + $dataId + ']:checked').map( function() {
            return this.value;
        }).get();
        this.debug ? console.debug('concernLocationName: ', concernLocationName) : '';
        this.debug ? console.debug('concernQualityId: ', concernQualityId) : '';

        $.ajax({
            url: "/manage/options/concernlocation/store",
            method: 'POST',
            data: {
                concern_location_name: concernLocationName,
                concern_quality_id: concernQualityId,
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

    deleteConcernLocationConfirm(e) {
        this.debug ? console.debug('deleteConcernLocationConfirm called. e: ', $(e.currentTarget)) : '';
        let $target = $("input[name='option_id']");
        let $targetId = $(e.currentTarget).data('id');
        this.debug ? console.debug('option id: ', $targetId) : '';
        $target.val($targetId);
        $('input[name="field_name"]').val('concernlocation');
        $('#confirm-delete-option').modal('show');
        $('#delete-option').on('click', () => {
            this.deleteConcernLocation(e);
        });
    }

    deleteConcernLocation(e) {
        let concernLocationId = $(e.currentTarget).data('id');
        let button = $('button.delete-location[data-id="' + concernLocationId + '"]');
        this.debug ? console.debug('concernLocationId: ', concernLocationId) : '';
        $('#confirm-delete-option').modal('hide');

        $.ajax({
            url: "/manage/options/concernlocation/delete/" + concernLocationId,
            method: 'POST',
            data: {
                concern_location_id: concernLocationId,
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

    addConcernLocation() {
        this.debug ? console.debug('New location clicked.') : '';
        let $target = $('#placeholder-concernlocation');
        let $parent = $target.parent();
        let $count = $(".no-show").length;
        let $newrow = $target.clone().appendTo($parent);

        $newrow.attr('id', 'placeholder-concernlocation-' + $count);
        $newrow.find('button, input').attr('data-id', 'new-' + $count);
        $newrow.find('input').attr('name', 'concernlocation-new-' + $count);
        $newrow.removeAttr('style');
    }

    removeConcernLocation(e) {
        this.debug ? console.debug('Remove location clicked.') : '';
        $(e.currentTarget).closest('.row').remove();
    }

};