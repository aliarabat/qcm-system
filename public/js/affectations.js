$(function () {

//génération select des filières By niveau
    $('#niveau').on('change', function () {
        var niveau = $(this).val();
        console.log(niveau);
        $.ajax({
            url: $('#routeNiveau').val(),
            dataType: 'JSON',
            data: {
                "_token": $('#form-professor input[name="_token"]').val(),
                "niveau": niveau
            },
            type: 'GET',
            //dataType: 'JSON',
            success: function (result) {
                var len = 0;
                len = result['data'].length;
                console.log(len);

                if (len != 0) {

                    var s = '<option value="m1" selected disabled>Filière</option>';
                    for (var i = 0; i < len; i++) {
                        var id = result['data'][i].id;
                        var name = result['data'][i].nom_filiere;
                        s += '<option value="' + id + '">' + name + '</option>';
                        $('select[name="filiere"]').html(s);
                        $('select[name="filiere"]').material_select();
                    }
                } else {
                    var s = '<option value="m1" selected disabled>Filière</option>';
                    $('select[name="filiere"]').html(s);
                    $('select[name="filiere"]').material_select();
                }
            },
            error: function () {
                //handle errors
                alert('error...');
            }
        });

    });

//génération des semestres par filière

    $('#filiere').on('change', function () {
        var filiere = $(this).val();
        console.log(filiere);
        $.ajax({
            url: $('#routeFiliere').val(),
            dataType: 'JSON',
            data: {
                "_token": $('#form-professor input[name="_token"]').val(),
                "filiere": filiere
            },
            type: 'GET',
            //dataType: 'JSON',
            success: function (result) {
                var len = 0;
                len = result['data'].length;
                console.log(len);

                if (len != 0) {

                    var s = '<option value="m1" selected disabled>Semestre</option>';
                    for (var i = 0; i < len; i++) {
                        var id = result['data'][i].id;
                        var name = result['data'][i].libelle;
                        s += '<option value="' + id + '">' + name + '</option>';
                        $('select[name="semestre"]').html(s);
                        $('select[name="semestre"]').material_select();
                    }
                } else {
                    var s = '<option value="m1" selected disabled>Semestre</option>';
                    $('select[name="semestre"]').html(s);
                    $('select[name="semestre"]').material_select();
                }
            },
            error: function () {
                //handle errors
                alert('error...');
            }
        });

    });


    //génération des modules par semestre

    $('#semestre').on('change', function () {
        var semestre = $(this).val();
        console.log(semestre);
        $.ajax({
            url: $('#routeSemestre').val(),
            dataType: 'JSON',
            data: {
                "_token": $('#form-professor input[name="_token"]').val(),
                "semestre": semestre
            },
            type: 'GET',
            //dataType: 'JSON',
            success: function (result) {
                var len = 0;
                len = result['data'].length;
                console.log(len);

                if (len != 0) {

                    var s = '<option value="m1" selected disabled>Module</option>';
                    for (var i = 0; i < len; i++) {
                        var id = result['data'][i].id;
                        var name = result['data'][i].nom_module;
                        s += '<option value="' + id + '">' + name + '</option>';
                        $('select[name="module"]').html(s);
                        $('select[name="module"]').material_select();
                    }
                } else {
                    var s = '<option value="m1" selected disabled>Module</option>';
                    $('select[name="module"]').html(s);
                    $('select[name="module"]').material_select();
                }
            },
            error: function () {
                //handle errors
                alert('error...');
            }
        });

    });


    //Submit affectation prof
    var formProfessor = $('#form-professor');
    formProfessor.submit(function (e) {
        e.preventDefault();
        $.post({
            url: formProfessor.data('route'),
            data: formProfessor.serializeArray(),
            dataType: 'JSON',
            success: function (data) {
                if (data == "Nouveau professeur associé à ce module") {
                    //var $toastContent = $("<span>"+data+"</span>").add($('<button class="btn-flat toast-action">Annuler</button>'));
                    //Materialize.toast($toastContent, 3000);
                    window.location.reload(true);
                    hideLoader('#form-professor button[type="submit"]', 'Affecter');
                    console.log(data)
                } else {
                    window.location.reload(true);
                    hideLoader('#form-professor button[type="submit"]', 'Affecter');
                    console.log(data)

                }

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
                location.reload();
                var $toastContent = $("<span>" + data + "</span>").add($('<button class="btn-flat toast-action">Annuler</button>'));
                Materialize.toast($toastContent, 3000);
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

function onDesafecter(id, desafcterFromDb) {
    if (desafcterFromDb == false) {
        $("#modal1 input[type='hidden']").val(id);
        console.log('desafecter modal opened');
        console.log(id);
    } else {
        console.log('Desafecter with ajax');
        var idsemestre_student = $("#modal1 input[type='hidden']").val();
        console.log(idsemestre_student);
        $.ajax({
            url: "http://127.0.0.1:8000/affectation/etudiants/" + idsemestre_student + "/desafecterEtudiant",
            dataType: 'JSON',
            data: {
                "_token": $('#form-student input[name="_token"]').val()
            },
            type: 'DELETE',
            success: function (result) {
                console.log(result);
                if (result = 1) {
                    $("#affectationStudent").load("http://127.0.0.1:8000/affectation/etudiants #affectationStudent");
                    $('#modal1').modal('close');

                } else {
                    alert("affectation introuvable");
                }
            }
        });
    }
}
