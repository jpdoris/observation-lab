import ManageOptions from './ManageOptions.es6';

new class Patient extends ManageOptions {

    constructor() {
        super();
        this.debug ? console.debug('Patient loaded, debugging turned on.') : '';
        this.bindEventsPatient();
    }

    bindEventsPatient() {
        $('#modal-body').on('click', '.update-patient', (e) => {
            this.debug ? console.debug('Update option button clicked.') : '';
            this.updatePatient(e);
        });

        $('#modal-body').on('click', '.create-patient', (e) => {
            this.debug ? console.debug('Create patient button clicked.') : '';
            this.createPatient(e);
        });

        $('#modal-body').on('click', '.remove-patient', (e) => {
            this.debug ? console.debug('Create patient button clicked.') : '';
            this.removePatient(e);
        });

        $('#modal-body').on('click', '.delete-patient', (e) => {
            this.debug ? console.debug('Delete patient button clicked.') : '';
            this.deletePatientConfirm(e);
        });

        $('#modal-body').on('click', '#new-patient', () => {
            this.debug ? console.debug('Add patient button clicked.') : '';
            this.addPatient();
        });
    }

    updatePatient(e) {
        let patientId = $(e.currentTarget).data('id');
        let patientName = $('input[name="patient-' + patientId + '"]').val();
        let button = $('button.update-patient[data-id="' + patientId + '"]');

        this.debug ? console.debug('patientId: ', patientId) : '';
        this.debug ? console.debug('patientName: ', patientName) : '';

        $.ajax({
            url: "/manage/options/patient/update/" + patientId,
            method: 'POST',
            data: {
                patient_id: patientId,
                patient_name: patientName,
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

    createPatient(e) {
        let $button = $(e.currentTarget);
        let $dataId = $button.data('id');
        this.debug ? console.debug('clicked element: ', $button) : '';
        let patientName = $('input[name=patient][data-id=' + $dataId + ']').val();
        this.debug ? console.debug('patientName: ', patientName) : '';

        $.ajax({
            url: "/manage/options/patient/store",
            method: 'POST',
            data: {
                patient_name: patientName,
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

    deletePatientConfirm(e) {
        this.debug ? console.debug('deletePatientConfirm called. e: ', $(e.currentTarget)) : '';
        let $target = $("input[name='option_id']");
        let $targetId = $(e.currentTarget).data('id');
        this.debug ? console.debug('option id: ', $targetId) : '';
        $target.val($targetId);
        $('input[name="field_name"]').val('patient');
        $('#confirm-delete-option').modal('show');
        $('#delete-option').on('click', () => {
            this.deletePatient(e);
        });
    }

    deletePatient(e) {
        let patientId = $(e.currentTarget).data('id');
        let button = $('button.delete-patient[data-id="' + patientId + '"]');
        this.debug ? console.debug('patientId: ', patientId) : '';
        $('#confirm-delete-option').modal('hide');

        $.ajax({
            url: "/manage/options/patient/delete/" + patientId,
            method: 'POST',
            data: {
                patient_id: patientId,
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

    addPatient(e) {
        this.debug ? console.debug('Add Patient option clicked.') : '';
        let $target = $('#placeholder-patient');
        let $parent = $target.parent();
        let $count = $(".no-show").length;
        let $newrow = $target.clone().appendTo($parent);

        $newrow.attr('id', 'placeholder-patient-' + $count);
        $newrow.find('button, input').attr('data-id', $count);
        $newrow.removeAttr('style');
    }

    removePatient(e) {
        this.debug ? console.debug('Remove Patient clicked.') : '';
        $(e.currentTarget).closest('.row').remove();
    }

};