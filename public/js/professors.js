$(function () {
    var form1 = $('#create-professor-form');
    var message;
    const btn=$('<button class="btn-flat toast-action">Annuler</button>');
    form1.submit(function (e) {
        e.preventDefault();
        $.post({
            url: form1.data('route'),
            data: form1.serializeArray(),
            beforeSend: function () {
                showLoader('#create-professor-form button[type="submit"]');
            },
            success: function (data) {
                hideLoader('#create-professor-form button[type="submit"]', 'Créer');
                if (data.status == 'PROFESSOR_FOUND') {
                    message = 'Professeur existe déja';
                } else if (data.status == 'CREATED_SUCCESSFULLY') {
                    form1.trigger('reset');
                    message = 'Professeur créé avec succés';
                } else {
                    message = 'Erreur inconnu';
                }
                Materialize.toast($('<span>'+message+'</span>').add(btn), 3000);
            },
            error: function () {
                hideLoader('#create-professor-form button[type="submit"]', 'Créer');
                message = 'Erreur inconnu';
                Materialize.toast($('<span>'+message+'</span>').add(btn), 3000);
            }
        });
    });

    var form2 = $('#form-import');
    form2.submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.post({
            url: form2.data('route'),
            data: formData,
            beforeSend: function () {
                showLoader('#form-import button[type="submit"]');
            },
            success: function (data) {
                hideLoader('#form-import button[type="submit"]', '', 'send');
                if (data.status == 'INVALID_FILE_FORMAT') {
                    message = 'Format du fichier est invalide';
                } else if (data.status == 'PROFESSORS_CREATED_SUCCESSFULLY') {
                    form2.trigger('reset');
                    message = 'Professeurs créés avec succés';
                }else{
                    message = 'Erreur inconnu';
                }
                Materialize.toast($('<span>'+message+'</span>').add(btn), 3000);
            },
            error: function (e) {
                hideLoader('#form-import button[type="submit"]', '', 'send');
                Materialize.toast($('<span>Erreur inconnu</span>').add($('<button class="btn-flat toast-action">Annuler</button>')), 3000);
            },
            contentType: false,
            cache: false,
            processData: false
        });
    });
});