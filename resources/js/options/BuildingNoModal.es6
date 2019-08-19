import ManageOptions from './ManageOptions.es6';

new class Building extends ManageOptions {

    constructor() {
        super();
        this.debug ? console.debug('Building loaded, debugging turned on.') : '';
        this.bindEventsBuilding();
    }

    bindEventsBuilding() {
        $('.update-building').on('click', (e) => {
            this.debug ? console.debug('Update building button clicked.') : '';
            this.updateBuilding(e);
        });

        $('.card-body').on('click', '.create-building', (e) => {
            this.debug ? console.debug('Create building button clicked.') : '';
            this.createBuilding(e);
        });

        $('#new-building').on('click', () => {
            this.debug ? console.debug('Add building button clicked.') : '';
            this.addBuilding();
        });

        $('.update-room').on('click', (e) => {
            this.debug ? console.debug('Update room button clicked.') : '';
            this.updateRoom(e);
        });

        $('.card-body').on('click', '.create-room', (e) => {
            this.debug ? console.debug('Create room button clicked.') : '';
            this.createRoom(e);
        });

        $('#new-room').on('click', () => {
            this.debug ? console.debug('Add room button clicked.') : '';
            this.addRoom();
        });
    }

    updateBuilding(e) {
        let $buildingId = $(e.currentTarget).data('id');
        let $buildingName = $('input[name="building-' + $buildingId + '"]').val();
        let $button = $('button.update-building[data-id="' + $buildingId + '"]');

        this.debug ? console.debug('buildingId: ', $buildingId) : '';
        this.debug ? console.debug('buildingName: ', $buildingName) : '';

        $.ajax({
            url: "/manage/options/building/update/" + $buildingId,
            method: 'POST',
            data: {
                building_id: $buildingId,
                building_name: $buildingName,
                _token: this.token,
            },
            beforeSend: super.showSpinner(button, 'save'),
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

    createBuilding(e) {
        let $button = $(e.currentTarget);
        let $dataId = $button.data('id');
        let $buildingName = $('input[name=building][data-id=' + $dataId + ']').val();

        this.debug ? console.debug('clicked element: ', $button) : '';
        this.debug ? console.debug('buildingName: ', $buildingName) : '';

        $.ajax({
            url: "/manage/options/building/store",
            method: 'POST',
            data: {
                building_name: $buildingName,
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
                    $('input[data-id=' + $dataId + ']').closest('tr').html('<td>' +
                        data.option_id + '</td><td><a href="/manage/options/building/edit/' +
                        data.option_id + '">' + $buildingName + '</a></td><td></td>');
                }
            },
        });
    }

    addBuilding(e) {
        this.debug ? console.debug('addBuilding method called.') : '';
        let $target = $('#placeholder-building');
        let $parent = $target.parent();
        let $count = $(".no-show").length;
        let $newrow = $target.clone().appendTo($parent);

        $newrow.attr('id', 'placeholder-building-' + $count);
        $newrow.find('button, input').attr('data-id', $count);
        $newrow.removeAttr('style');
    }

    updateRoom(e) {
        let $roomId = $(e.currentTarget).data('id');
        let $roomName = $('input[name="room-' + $roomId + '"]').val();
        let $buildingId = $('input[name="building-' + $roomId + '"]:checked').val();
        let $button = $('button.update-room[data-id="' + $roomId + '"]');

        this.debug ? console.debug('roomId: ', $roomId) : '';
        this.debug ? console.debug('roomName: ', $roomName) : '';
        this.debug ? console.debug('buildingId: ', $buildingId) : '';

        $.ajax({
            url: "/manage/options/room/update/" + $roomId,
            method: 'POST',
            data: {
                room_id: $roomId,
                room_name: $roomName,
                building_id: $buildingId,
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

    createRoom(e) {
        let $button = $(e.currentTarget);
        let $dataId = $button.data('id');
        let $roomName = $('input[name=room][data-id=' + $dataId + ']').val();
        let $buildingId = $('input[name=building]').val();

        this.debug ? console.debug('clicked element: ', $button) : '';
        this.debug ? console.debug('roomName: ', $roomName) : '';
        this.debug ? console.debug('buildingId: ', $buildingId) : '';

        $.ajax({
            url: "/manage/options/room/store",
            method: 'POST',
            data: {
                room_name: $roomName,
                building_id: $buildingId,
                _token: this.token,
            },
            beforeSend: super.showSpinner($button, 'save'),
            success: (data) => {
                this.debug ? console.debug('ajax response: ', data) : '';
                super.hideSpinner($button, 'save');
                if (!$.isEmptyObject(data.error)) {
                    super.printErrorMsg(data.error);
                } else {
                    $('input[data-id=' + $dataId + ']').closest('div.no-show').html('');
                    $('.room-block').append('' +
                        '                 <div class="form-check">' +
                        '                 <label class="form-check-label col-form-label">' +
                        '                 <input class="form-check-input"' +
                        '                 type="checkbox"' +
                        '                 name="room_id[]"' +
                        '                 value="' + data.option_id + '" checked>' +
                        '                 <a href="/manage/options/building/editroom/' + $buildingId + '">' + $roomName + '</a>' +
                        '                 </label>' +
                        '                 </div>');
                    super.printSuccessMsg(data.success);
                }
            },
        });
    }

    addRoom() {
        this.debug ? console.debug('New room clicked.') : '';
        let $target = $('#placeholder-room');
        let $parent = $target.parent();
        let $count = $(".no-show").length;
        let $newrow = $target.clone().appendTo($parent);

        $newrow.attr('id', 'placeholder-room-' + $count);
        $newrow.find('button, input').attr('data-id', $count);
        $newrow.removeAttr('style');
    }
};