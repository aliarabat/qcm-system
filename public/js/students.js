$(function () {
    var form1 = $('#create-student-form');
    var message;
    const btn = $('<button class="btn-flat toast-action">Annuler</button>');
    form1.submit(function (e) {
        e.preventDefault();
        $.post({
            url: form1.data('route'),
            data: form1.serializeArray(),
            beforeSend: function () {
                showLoader('#create-student-form button[type="submit"]');
            },
            success: function (data) {
                hideLoader('#create-student-form button[type="submit"]', 'Créer');
                if (data.status=='STUDENT_FOUND') {
                    message='Etudiant existe déja';
                }else if(data.status=='CREATED_SUCCESSFULLY'){
                    form1.trigger('reset');
                    message='Etudiant créé avec succés';
                }else{
                    message='Problème inconnu';
                }
                Materialize.toast($('<span>'+message+'</span>').add(btn), 3000);
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
                hideLoader('#form-import button[type="submit"]', '', 'send');
                if (data.status == 'INVALID_FILE_FORMAT') {
                    message = 'Format du fichier est invalide';
                } else if (data.status == 'STUDENTS_CREATED_SUCCESSFULLY') {
                    form2.trigger('reset');
                    message = 'Etudiants créés avec succés';
                }else{
                    message = 'Erreur inconnu';
                }
                Materialize.toast($('<span>'+message+'</span>').add(btn), 3000);
            },
            error: function (e) {
                hideLoader('#form-import button[type="submit"]', '', 'send');
                Materialize.toast($('<span>Erreur inconnu</span>').add(btn), 3000);
            },
            contentType: false,
            cache: false,
            processData: false
        });
    });
});