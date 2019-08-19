$(document).ready(function() {

    var that = this;
    this.hash = window.location.hash.substr(1);
    this.debug = (this.hash == 'debug') ? true : false;

    $("#reviewed_by").on('input', function() {
        if ($(this).val().length > 2) {
            loadReviewers();
        }
    });


    function loadReviewers() {
        console.log('input:',$("#reviewed_by").val()); // todo
        that.debug ? console.debug('datalist triggered') : '';
        var selectedval = $("#reviewed_by").val();
        var token = $("input[name='_token']").val();
        var target = $("datalist[name='reviewers']");
        $.ajax({
            url: "/lookup/reviewers",
            method: 'POST',
            data: {reviewed_by:selectedval, _token:token},
            success: function(data) {
                $("datalist[name='reviewers']").html('');
                $("datalist[name='reviewers']").html(data.options);
                if (!$.trim(data.options)) {
                    $(target).empty();
                    $(target).attr('disabled', 'disabled');
                }
            }
        });
    }

});