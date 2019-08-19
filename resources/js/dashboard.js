$(document).ready(function() {

    var that = this; // (╯°□°）╯︵ ┻━┻

    this.hash = window.location.hash.substr(1);
    this.token = $("input[name='_token']").val();
    this.debug = (this.hash == 'debug') ? true : false;

    $('.assign-to-me').on('click', function (e) {
        assignToMe(e);
    });

    $('.sort-reports').on('click', function(e) {
        sortTable(e, 'reports');
    });

    $('.sort-history').on('click', function(e) {
        sortTable(e, 'history');
    });


    function sortTable(e, $table) {
        var $cookie = getCookie('sort_options');
        var $target = $(e.currentTarget);
        var $column = $target.data('column');
        var $sort_options = {
            "reports": {
                "sortby": "created_at",
                "order": "asc",
                "reverse": "desc",
                "arrow": "up",
            },
            "history": {
                "sortby": "created_at",
                "order": "asc",
                "reverse": "desc",
                "arrow": "down",
            },
        };

        that.debug ? console.debug('cookie: ', $cookie) : '';
        that.debug ? console.debug('target: ', $target) : '';
        that.debug ? console.debug('table: ', $table) : '';
        that.debug ? console.debug('column: ', $column) : '';

        if ($cookie) {
            $sort_options = JSON.parse($cookie);
        }
        $sort_options[$table].sortby = $column;
        if ($sort_options[$table].order == 'asc') {
            $sort_options[$table].order = 'desc';
            $sort_options[$table].reverse = 'asc';
            $sort_options[$table].arrow = 'up';
        } else {
            $sort_options[$table].order = 'asc';
            $sort_options[$table].reverse = 'desc';
            $sort_options[$table].arrow = 'down';
        }

        var $sort_options_str = JSON.stringify($sort_options);
        that.debug ? console.debug('sort options str: ', $sort_options_str) : '';
        setCookie('sort_options', $sort_options_str, 1);
        location.reload();
    }

    function setCookie(name,value,days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }

    function eraseCookie(name) {
        document.cookie = name+'=; Max-Age=-99999999;';
    }

    function assignToMe(e) {
        that.debug ? console.debug('Assign to me clicked.') : '';
        var $id = $(e.currentTarget).data('id');
        var $userId = $(e.currentTarget).data('userid');
        var $target = $(e.currentTarget).closest('.table-row-select td');

        that.debug ? console.debug('id: ', $id) : '';
        that.debug ? console.debug('userId: ', $userId) : '';
        that.debug ? console.debug('target: ', $target) : '';
        that.debug ? console.debug('token: ', that.token) : '';

        $.ajax({
            url: "/report/assign",
            method: 'POST',
            data: {
                report_id:$id,
                user_id: $userId,
                _token:that.token,
            },
            success: function(data) {
                that.debug ? console.debug('ajax response: ', data) : '';
                updateAssignment($target, data.username);
            },
        });
    }

    function updateAssignment(target, username) {
        target.html(username);
    }
});