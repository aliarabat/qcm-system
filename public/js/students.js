$(function () {
    var form1 = $('#create-student-form');
    form1.submit(function (e) {
        e.preventDefault();
        $.post({
            url: form1.data('route'),
            data: form1.serializeArray(),
            beforeSend: function () {
                showLoader('#create-student-form button[type="submit"]');
            },
            success: function (data) {
                console.log(data);
                hideLoader('#create-student-form button[type="submit"]', 'Créer');
            },
            error: function (e) {
                hideLoader('#create-student-form button[type="submit"]', 'Créer');
            },
            dataType: 'JSON',

        });
    });
    var form2 = $('#form-import');
    form2.submit(function (e) {
        e.preventDefault();
        var formData=new FormData(this);
        $.post({
            url: form2.data('route'),
            data: formData,
            beforeSend: function () {
                showLoader('#form-import button[type="submit"]');
            },
            success: function (data) {
                console.log(data);
                hideLoader('#form-import button[type="submit"]', '', 'send');
            },
            error: function (e) {
                hideLoader('#form-import button[type="submit"]', '', 'send');
            },
            contentType: false,
            cache: false,
            processData: false
        });
    });
});