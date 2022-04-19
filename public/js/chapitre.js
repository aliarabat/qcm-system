$(function () {
    $('#filiereChapitre').on('change', function () {
        document.getElementById('nameFiliereChapitre_error').innerHTML = '';
        $("#chapitreSubmit").click(function () {
            if (document.getElementById('nameModule_error').nodeValue == null) {
                document.getElementById('nameModule_error').innerHTML = 'Veuillez choisir le module';
            }
        });

    });
    $('#moduleChapitre').on('change', function () {
        document.getElementById('nameModule_error').innerHTML = '';
    });
    $("#chapitreSubmit").click(function () {
        if ($('#filiereChapitre').val() == null) {
            if (document.getElementById('nameFiliereChapitre_error').nodeValue == null) {
                document.getElementById('nameFiliereChapitre_error').innerHTML = 'Veuillez choisir la filière';
            }
        }

    });

    $('#filiereChapitre').on('change', function () {
        var nom_filiere = $(this).val();
        $.ajax({
            url: $('#routeFiliereChapitre').val(),
            dataType: 'JSON',
            data: {
                "_token": $('#chapitre-form input[name="_token"]').val(),
                "nom_filiere": nom_filiere
            },
            type: 'GET',
            dataType: 'JSON',
            success: function (result) {
                var len = 0;
                len = result['data'].length;
                console.log(len);

                if (len != 0) {
                    var s = '<option value="m1" selected disabled>Module</option>';
                    for (var i = 0; i < len; i++) {
                        var id = result['data'][i].id;
                        var name = result['data'][i].nom_module;
                        s += '<option value="' + name + '">' + name + '</option>';
                        $('select[name="moduleChapitre"]').html(s);
                        $('select[name="moduleChapitre"]').material_select();
                    }
                } else {
                    //$('select[name="moduleChapitre"]').empty();
                    var s = '<option value="m1" selected disabled>Module</option>';
                    $('select[name="moduleChapitre"]').html(s);
                    $('select[name="moduleChapitre"]').material_select();
                }
            },
            error: function () {
                //handle errors
                alert('error...');
            }
        });

    });

    if ($("#chapitre-form").length > 0) {
        $("#chapitre-form").validate({

            rules: {
                filiereChapitre: {
                    required: function () {
                        return $('#filiereChapitre').val() != 'Filière';
                    },
                },
                moduleChapitre: {
                    required: function () {
                        return $('#moduleChapitre').val() != 'Module';
                    },
                },
                agree: 'required',
                nom_chapitre: {
                    required: true,
                    maxlength: 100,
                },
            },
            messages: {
                filiereChapitre: {
                    required: "Veuillez choisir la filière",
                },
                moduleChapitre: {
                    required: "Veuillez choisir le module",
                },
                nom_chapitre: {
                    required: "Veuillez saisir le nom du chapitre",
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
                document.getElementById('nameFiliereChapitre_error').innerHTML = '';
                document.getElementById('nameModule_error').innerHTML = ''
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#chapitreSubmit').html('Sending..');
                $.ajax({
                    url: $('#chapitreSubmit').val(),
                    type: "POST",
                    data: $('#chapitre-form').serialize(),
                    success: function (response) {
                        $('#chapitreSubmit').html('Créer');
                        $('#res_message').show();
                        $('#res_message').html(response.msg);
                        $('#msg_div').removeClass('d-none');
                        $('#chapitreIn').val("");
                        setTimeout(function () {
                            $('#res_message').hide();
                            $('#msg_div').hide();
                        }, 10000);
                        console.log(response);
                        if (response == "Le nouveau chapitre a été associé au module") {
                            $("#tableChapitres").load("http://127.0.0.1:8000/mainparts/chapitre #tableChapitres");
                            var $toastContent = $("<span>" + response + "</span>").add($('<button class="btn-flat toast-action">Annuler</button>'));
                            Materialize.toast($toastContent, 3000);
                        } else if (response == "Ce Chapitre a été associé au module") {
                            $("#tableChapitres").load("http://127.0.0.1:8000/mainparts/chapitre #tableChapitres");
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


//mettre a jour le chapitre
function onUpdateChapitre(id, chapitre, updateInDb) {
    if (updateInDb == false) {
        $("#modal4 input[type='hidden']").val(id);
        $("#modal4 input[type='text']:first").val(chapitre);
        console.log('Opened Modal');
    } else {
        console.log('Called Ajax');

        var idChapitre = $("#modal4 input[type='hidden']").val();
        var chapitre = $("#modal4 input[type='text']:first").val();

        $.post({
            url: "http://127.0.0.1:8000/mainparts/chapitre/" + idChapitre + "/updateChapitre",
            dataType: 'JSON',
            data: {
                "_token": $('#chapitre-form input[name="_token"]').val(),
                "chapitre": chapitre
            },
            success: function (result) {
                console.log(result);
                if (result = 1) {
                    $("#tableChapitres").load("http://127.0.0.1:8000/mainparts/chapitre #tableChapitres");
                    $('#modal4').modal('close');
                    //window.location.reload();
                } else if (result = -1) {
                    $('#modal4').modal('close');
                    alert("Chapitre existe déja");
                } else {
                    $('#modal4').modal('close');
                    alert("Chapitre introuvable");
                }
            }
        });
    }
}

//Delete le chapitre
function onDeleteChapitre(id, deleteFromDb) {
    if (deleteFromDb == false) {
        $("#delete4 input[type='hidden']").val(id);
        console.log('delete modal opened');
        //console.log(id);
    } else {
        console.log('Delete with ajax');
        //Suppression d'un niveau avec ajax
        var idChapitre = $("#delete4 input[type='hidden']").val();
        $.ajax({
            url: "http://127.0.0.1:8000/mainparts/chapitre/" + idChapitre + "/deleteChapitre",
            dataType: 'JSON',
            data: {
                "_token": $('#chapitre-form input[name="_token"]').val(),
            },
            type: 'DELETE',
            success: function (result) {
                console.log(result);
                if (result = 1) {
                    $("#tableChapitres").load("http://127.0.0.1:8000/mainparts/chapitre #tableChapitres");
                    $('#delete4').modal('close');
                } else {
                    alert("Chapitre introuvable");
                }
            }
        });
    }
}
