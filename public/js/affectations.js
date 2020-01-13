$(function () {
    var formProfessor = $('#form-professor');
    formProfessor.submit(function (e) {
        e.preventDefault();
        $.post({
            url: formProfessor.data('route'),
            data: formProfessor.serializeArray(),
            dataType: 'JSON',
            success: function (data) {
                hideLoader('#form-professor button[type="submit"]', 'Affecter');

            },
            error: function () {
                hideLoader('#form-professor button[type="submit"]', 'Affecter');

            },
            beforeSend: function () {
                showLoader('#form-professor button[type="submit"]');
            },
        });
    });

    var formStudent = $('#form-student');
    formStudent.submit(function (e) {
        e.preventDefault();
        $.post({
            url: formStudent.data('route'),
            data: formStudent.serializeArray(),
            dataType: 'JSON',
            success: function (data) {
                hideLoader('#form-student button[type="submit"]', 'Affecter');

            },
            error: function () {
                hideLoader('#form-student button[type="submit"]', 'Affecter');

            },
            beforeSend: function () {
                showLoader('#form-student button[type="submit"]');
            },
        });
    });
})