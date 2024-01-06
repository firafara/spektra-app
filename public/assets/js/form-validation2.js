$(function () {
    $("#main_form2").on('submit', function (e) {
        e.preventDefault();
        $('#btn-submit').hide();
        $('#btn-cancel').hide();
        $("<div id='loading'><a style='position: absolute;top: 50%;left: 50%;font-size: 50px;color: white;transform: translate(-50%,-50%);-ms-transform: translate(-50%,-50%);'>Loading...</a></div>").css({
            "position": "fixed",
            "top": "0px",
            "left": "0px",
            "width": "100%",
            "height": "100%",
            "background-color": "#000",
            "filter": "alpha(opacity=50)",
            "opacity": "0.5",
            "z-index": "10000",
            "vertical-align": "middle",
            "text-align": "center",
            "color": "#fff",
            "font-size": "40px",
            "font-weight": "bold",
            "cursor": "wait"
        }).appendTo("body");
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(document).find('span.error-text').text('');
            },
            success: function (data) {
                const element = document.getElementById("loading");
                if (data.status == 0 && data.error_detail) {
                    element.remove();
                    $.each(data.error_detail, function (prefix, val) {
                        var temp = prefix.replace(/\./g, '_');
                        $('span.' + temp + '_error').text(val[0]);
                    });
                } else if (data.status == 0) {
                    element.remove();
                    $.each(data.error, function (prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);
                    });
                } else {
                    $('#btn-submit').hide();
                    $('#btn-cancel').hide();
                    $('#main_form')[0].reset();
                    window.location.replace(data.url);
                    toastr.success(data.message)
                }
            }
        });
    });
});