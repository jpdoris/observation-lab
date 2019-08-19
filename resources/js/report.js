$(document).ready(function(){

    var that = this;  // (╯°□°）╯︵ ┻━┻
    this.hash = window.location.hash.substr(1);
    this.debug = (this.hash == 'debug') ? true : false;

    // select box listeners
    $('#animal_type_id').on('change', function() {
        this.debug ? console.debug('loadAnimalSubtypes, loadConcernQualities called on change') : '';
        loadAnimalSubtypes();
        loadConcernQualities();
    });

    $('#concern_quality_id').on('change', function() {
        this.debug ? console.debug('loadConcernLocations called on change') : '';
        loadConcernLocations();
    });

    $('#building_id').on('change', function() {
        this.debug ? console.debug('loadRooms called on change') : '';
        loadRooms();
    });


    // datalist listeners
    $('input[list]').on('input', function(e) {
        setDatalistValue(e);
    });


    // functions

    function loadAnimalSubtypes() {
        var target = $('#animal_subtype_id');
        var animal_type_id = $('#animal_type_id').val();
        var selectedval = $('#animal_subtype_id').val();
        var token = $("input[name='_token']").val();
        $(target).removeAttr('disabled');
        $.ajax({
            url: "/lookup/animal-subtype",
            method: 'POST',
            data: {animal_type_id:animal_type_id, animal_subtype_id:selectedval, _token:token},
            beforeSend: showSpinner(target),
            success: function(data) {
                $("select[name='animal_subtype_id']").html('');
                $("select[name='animal_subtype_id']").html(data.options);
                hideSpinner(target);
                if (!$.trim(data.options)) {
                    $(target).empty();
                    $(target).attr('disabled', 'disabled');
                }
            }
        });
    }

    function loadConcernQualities() {
        var target = $('#concern_quality_id');
        var animal_type_id = $('#animal_type_id').val();
        var selectedval = $('#concern_quality_id').val();
        var token = $("input[name='_token']").val();
        $(target).removeAttr('disabled');
        $.ajax({
            url: "/lookup/concern-quality",
            method: 'POST',
            data: {animal_type_id:animal_type_id, concern_quality_id:selectedval, _token:token},
            beforeSend: showSpinner(target),
            success: function(data) {
                $("select[name='concern_quality_id']").html('');
                $("select[name='concern_quality_id']").html(data.options);
                hideSpinner(target);
                if (!$.trim(data.options)) {
                    $(target).empty();
                    $(target).attr('disabled', 'disabled');
                }
            }
        });
    }

    function loadConcernLocations() {
        var target = $('#concern_location_id');
        var concern_quality_id = $('#concern_quality_id').val();
        var selectedval = $('#concern_location_id').val();
        var token = $("input[name='_token']").val();
        $(target).removeAttr('disabled');
        $.ajax({
            url: "/lookup/concern-location",
            method: 'POST',
            data: {concern_quality_id:concern_quality_id, concern_location_id:selectedval, _token:token},
            beforeSend: showSpinner(target),
            success: function(data) {
                $("select[name='concern_location_id']").html('');
                $("select[name='concern_location_id']").html(data.options);
                hideSpinner(target);
                if (!$.trim(data.options)) {
                    $(target).empty();
                    $(target).attr('disabled', 'disabled');
                }
            }
        });
    }

    function loadRooms() {
        var target = $('#room_id');
        var building_id = $('#building_id').val();
        var selectedval = $('#room_id').val();
        var token = $("input[name='_token']").val();
        $(target).removeAttr('disabled');
        $.ajax({
            url: "/lookup/room",
            method: 'POST',
            data: {building_id:building_id, room_id:selectedval, _token:token},
            beforeSend: showSpinner(target),
            success: function(data) {
                $("select[name='room_id']").html('');
                $("select[name='room_id']").html(data.options);
                hideSpinner(target);
                if (!$.trim(data.options)) {
                    $(target).empty();
                    $(target).attr('disabled', 'disabled');
                }
            }
        });
    }


    function setDatalistValue(e) {
        var $input = $(e.target),
            $options = $('#' + $input.attr('list') + ' option'),
            $hiddenInput = $('#' + $input.attr('id') + '-hidden'),
            $existingInput = $('#' + $input.attr('id') + '-exists'),
            $label = $input.val();

        $hiddenInput.val(label);
        that.debug ? console.debug('hiddeninput val: ', $hiddenInput.val()) : '';

        for(var i = 0; i < $options.length; i++) {
            var $option = $options.eq(i);

            if($option.text() === $label) {
                $hiddenInput.val( $option.attr('data-value') );
                $existingInput.val(1);
                break;
            }
        }
    }


    function showSpinner(target) {
        $(target).children().remove();
        target.addClass('spinner');
    }

    function hideSpinner(target) {
        target.removeClass('spinner');
    }

});
