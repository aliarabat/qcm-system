$(function () {
    var form=$('#create-professor-form');
    console.log();
    form.submit(function (e) { 
        e.preventDefault();
        $.post({
            url: form.data('route'),
            data: form.serializeArray(),
            beforeSend: function () { 
                showLoader('#create-professor-form button[type="submit"]');
            },
            success: function (data) { 
                console.log(data);
                hideLoader('#create-professor-form button[type="submit"]', 'Créer');
            },
        });
    });
});