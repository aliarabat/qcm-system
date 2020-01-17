$(function () {
    $('#niveauFiliere').on('change', function () {
        document.getElementById('nameNiveau_error').innerHTML = '';
    });
    $("#filiereSubmit").click(function () {
        if (document.getElementById('nameNiveau_error').nodeValue == null) {
            document.getElementById('nameNiveau_error').innerHTML = 'Veuillez choisir le niveau';
        }
    });
    if ($("#filiere-form").length > 0) {
        $("#filiere-form").validate({

            rules: {
                nom_filiere: {
                    required: true,
                    maxlength: 100,
                },
                libelle: {
                    required: true,
                    maxlength: 10,
                },
                semestres: {
                    required: true,
                    min: 1,
                },
            },
            messages: {

                nom_filiere: {
                    required: "Veuillez saisir le nom de la filière",
                },
                libelle: {
                    required: "Veuillez saisir le libellé de la filière",
                },
                semestres: {
                    required: "Veuillez saisir le nombre de semestres",
                    min: "Nombre minimum de semestres 1",
                },
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                document.getElementById('nameNiveau_error').innerHTML = '';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#filiereSubmit').html('Sending..');
                $.ajax({
                    url: $('#filiereSubmit').val(),
                    type: "POST",
                    data: $('#filiere-form').serialize(),
                    success: function (response) {
                        $('#filiereSubmit').html('Créer');
                        $('#res_message').show();
                        $('#res_message').html(response.msg);
                        $('#msg_div').removeClass('d-none');
                        $('#filiereIn').val("");
                        $('#libelleIn').val("");
                        $('#semestres').val("");
                        setTimeout(function () {
                            $('#res_message').hide();
                            $('#msg_div').hide();
                        }, 10000);
                        console.log(response);
                        if (response == "Filière avec ses semestres ont été créés") {
                            $("#tableFilieres").load("http://127.0.0.1:8000/mainparts/filiere #tableFilieres");
                            var $toastContent = $("<span>" + response + "</span>").add($('<button class="btn-flat toast-action">Annuler</button>'));
                            Materialize.toast($toastContent, 3000);

                        } else {
                            var $toastContent = $("<span>" + response + "</span>").add($('<button class="btn-flat toast-action">Annuler</button>'));
                            Materialize.toast($toastContent, 3000);
                        }


                    }
                });

            }

        })
    }


})

//mettre a jour la filiere
function onUpdateFiliere(id, niveau, filiere, libelle, updateInDb) {
    if (updateInDb == false) {
        $("#modal2 input[type='hidden']").val(id);
        $("#modal2 input[name='updatedFiliere']").val(filiere);
        $("#modal2 input[type='text']:first").val(niveau);
        $("#modal2 input[type='text']:last").val(libelle);
        console.log('Opened Modal');
    } else {
        console.log('Called Ajax');

        var idFiliere = $("#modal2 input[type='hidden']").val();
        var nomFiliere = $("#modal2 input[name='updatedFiliere']").val();
        var libelle = $("#modal2 input[type='text']:last").val();
        var niveau = $("#modal2 input[type='text']:first").val();

        $.post({
            url: "http://127.0.0.1:8000/mainparts/filiere/" + idFiliere + "/updateFiliere",
            dataType: 'JSON',
            data: {
                "_token": $('#filiere-form input[name="_token"]').val(),
                "nomFiliere": nomFiliere,
                "libelle": libelle,
                "niveau": niveau
            },
            success: function (result) {
                if (result = 1) {
                    $("#tableFilieres").load("http://127.0.0.1:8000/mainparts/filiere #tableFilieres");
                    $('#modal2').modal('close');
                    console.log(1);

                } else if (result = -1) {
                    $('#modal2').modal('close');
                    console.log(-1);
                } else {
                    $('#modal2').modal('close');
                    console.log(-2);
                }
            }
        });
    }
}


//Delete le filiere
function onDeleteFiliere(id, deleteFromDb) {
    if (deleteFromDb == false) {
        $("#delete2 input[type='hidden']").val(id);
        console.log('delete modal opened');
        //console.log(id);
    } else {
        console.log('Delete with ajax');
        //Suppression d'un niveau avec ajax
        var idFiliere = $("#delete2 input[type='hidden']").val();

        $.ajax({
            url: "http://127.0.0.1:8000/mainparts/filiere/" + idFiliere + "/deleteFiliere",
            dataType: 'JSON',
            data: {
                "_token": $('#filiere-form input[name="_token"]').val()
            },
            type: 'DELETE',
            success: function (result) {
                console.log(result);
                if (result = 1) {
                    $("#tableFilieres").load("http://127.0.0.1:8000/mainparts/filiere #tableFilieres");
                    $('#delete2').modal('close');
                    console.log(1);
                } else {
                    console.log(-1);
                }
            }
        });
    }
}

