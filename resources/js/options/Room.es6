import ManageOptions from './ManageOptions.es6';

new class Room extends ManageOptions {

    constructor() {
        super();
        this.debug ? console.debug('Room loaded, debugging turned on.') : '';
        this.bindEventsRoom();
    }

    bindEventsRoom() {
        $('#modal-body').on('click', '.update-room', (e) => {
            this.debug ? console.debug('Update room button clicked.') : '';
            this.updateRoom(e);
        });

        $('#modal-body').on('click', '.create-room', (e) => {
            this.debug ? console.debug('Create room button clicked.') : '';
            this.createRoom(e);
        });

        $('#modal-body').on('click', '.remove-room', (e) => {
            this.debug ? console.debug('Create room button clicked.') : '';
            this.removeRoom(e);
        });

        $('#modal-body').on('click', '.delete-room', (e) => {
            this.debug ? console.debug('Delete room button clicked.') : '';
            this.deleteRoomConfirm(e);
        });

        $('#modal-body').on('click', '#new-room', () => {
            this.debug ? console.debug('Add room button clicked.') : '';
            this.addRoom();
        });
    }

    updateRoom(e) {
        let roomId = $(e.currentTarget).data('id');
        let roomName = $('input[name="room-' + roomId + '"]').val();
        let buildingId = $('input[name="building-' + roomId + '"]:checked').val();
        let button = $('button.update-room[data-id="' + roomId + '"]');

        this.debug ? console.debug('roomId: ', roomId) : '';
        this.debug ? console.debug('roomName: ', roomName) : '';
        this.debug ? console.debug('buildingId: ', buildingId) : '';

        $.ajax({
            url: "/manage/options/room/update/" + roomId,
            method: 'POST',
            data: {
                room_id: roomId,
                room_name: roomName,
                building_id: buildingId,
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

    createRoom(e) {
        let $button = $(e.currentTarget);
        let $dataId = $button.data('id');
        this.debug ? console.debug('clicked element: ', $button) : '';

        let roomName = $('input[name=room][data-id=' + $dataId + ']').val();
        let buildingId = $('input[name=building][data-id=' + $dataId + ']:checked').val();
        this.debug ? console.debug('roomName: ', roomName) : '';
        this.debug ? console.debug('buildingId: ', buildingId) : '';

        $.ajax({
            url: "/manage/options/room/store",
            method: 'POST',
            data: {
                room_name: roomName,
                building_id: buildingId,
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

    deleteRoomConfirm(e) {
        this.debug ? console.debug('deleteRoomConfirm called. e: ', $(e.currentTarget)) : '';
        let $target = $("input[name='option_id']");
        let $targetId = $(e.currentTarget).data('id');
        this.debug ? console.debug('option id: ', $targetId) : '';
        $target.val($targetId);
        $('input[name="field_name"]').val('room');
        $('#confirm-delete-option').modal('show');
        $('#delete-option').on('click', () => {
            this.deleteRoom(e);
        });
    }

    deleteRoom(e) {
        let roomId = $(e.currentTarget).data('id');
        let button = $('button.delete-room[data-id="' + roomId + '"]');
        this.debug ? console.debug('roomId: ', roomId) : '';
        $('#confirm-delete-option').modal('hide');

        $.ajax({
            url: "/manage/options/room/delete/" + roomId,
            method: 'POST',
            data: {
                room_id: roomId,
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

    addRoom() {
        this.debug ? console.debug('New room clicked.') : '';
        let $target = $('#placeholder-room');
        let $parent = $target.parent();
        let $count = $(".no-show").length;
        let $newrow = $target.clone().appendTo($parent);

        $newrow.attr('id', 'placeholder-room-' + $count);
        $newrow.find('button, input').attr('data-id', $count);
        $newrow.find('input[name=building]').each( function(el) {
            $(this).attr('id', 'building-new-' + $count + '-' + $(this).val());
            $(this).next('label').attr('for', 'building-new-' + $count + '-' + $(this).val());
        });
        $newrow.removeAttr('style');
    }

    removeRoom(e) {
        this.debug ? console.debug('Remove room clicked.') : '';
        $(e.currentTarget).closest('.row').remove();
    }

};