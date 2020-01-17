$(function () {
    $('#filiereModule').on('change', function () {
        document.getElementById('nameFiliere_error').innerHTML = '';
    });
    $('#semestreFiliere').on('change', function () {
        document.getElementById('nameSemestreFiliere_error').innerHTML = '';
    });
    $("#moduleSubmit").click(function () {
        if (document.getElementById('nameFiliere_error').nodeValue == null) {
            document.getElementById('nameFiliere_error').innerHTML = 'Veuillez choisir la filière';
            if (document.getElementById('nameSemestreFiliere_error').nodeValue == null) {
                document.getElementById('nameSemestreFiliere_error').innerHTML = 'Veuillez choisir le semestre';
            }
        }

        if (document.getElementById('nameSemestreFiliere_error').nodeValue == null) {
            document.getElementById('nameSemestreFiliere_error').innerHTML = 'Veuillez choisir le semestre';
            if (document.getElementById('nameFiliere_error').nodeValue == null) {
                document.getElementById('nameFiliere_error').innerHTML = 'Veuillez choisir la filière';
            }
        }
    });
    $('#filiereModule').on('change', function () {
        var nom_filiere = $(this).val();
        console.log(nom_filiere);
        $.ajax({
            url: $('#routeFiliereModule').val(),
            dataType: 'JSON',
            data: {
                "_token": $('#module-form input[name="_token"]').val(),
                "nom_filiere": nom_filiere
            },
            type: 'GET',
            dataType: 'JSON',
            success: function (result) {
                var len = 0;
                len = result['data'].length;
                console.log(len);

                if (len != 0) {

                    var s = '<option value="m1" selected disabled>Semestre</option>';
                    for (var i = 0; i < len; i++) {
                        var id = result['data'][i].id;
                        var name = result['data'][i].libelle;
                        s += '<option value="' + name + '">' + name + '</option>';
                        $('select[name="semestreFiliere"]').html(s);
                        $('select[name="semestreFiliere"]').material_select();
                    }
                } else {
                    var s = '<option value="m1" selected disabled>Semestre</option>';
                    $('select[name="semestreFiliere"]').html(s);
                    $('select[name="semestreFiliere"]').material_select();
                }
            },
            error: function () {
                //handle errors
                alert('error...');
            }
        });

    });
    if ($("#module-form").length > 0) {
        $("#module-form").validate({

            rules: {

                agree: 'required',
                nom_module: {
                    required: true,
                    maxlength: 100,
                },
                libelleModule: {
                    required: true,
                    maxlength: 10,
                },
            },
            messages: {
                filiereModule: {
                    required: "Veuillez choisir la filière",
                },
                nom_module: {
                    required: "Veuillez saisir le nom du module",
                },
                libelleModule: {
                    required: "Veuillez saisir le libellé du module",
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
                document.getElementById('nameFiliere_error').innerHTML = '';
                document.getElementById('nameSemestreFiliere_error').innerHTML = '';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#moduleSubmit').html('Sending..');
                $.ajax({
                    url: $('#moduleSubmit').val(),
                    type: "POST",
                    data: $('#module-form').serialize(),
                    success: function (response) {
                        $('#moduleSubmit').html('Créer');
                        $('#res_message').show();
                        $('#res_message').html(response.msg);
                        $('#msg_div').removeClass('d-none');
                        $('#moduleIn').val("");
                        $('#libelleModuleIn').val("");
                        setTimeout(function () {
                            $('#res_message').hide();
                            $('#msg_div').hide();
                        }, 10000);
                        console.log(response);
                        if (response == "Ce module a été associé à cette filière") {
                            $("#tableModules").load("http://127.0.0.1:8000/mainparts/module #tableModules");
                            var $toastContent = $("<span>" + response + "</span>").add($('<button class="btn-flat toast-action">Annuler</button>'));
                            Materialize.toast($toastContent, 3000);
                        } else if (response == "Module a été créée") {
                            $("#tableModules").load("http://127.0.0.1:8000/mainparts/module #tableModules");
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


//mettre a jour le module
function onUpdateModule(id, module, libelle, updateInDb) {
    if (updateInDb == false) {
        $("#modal3 input[type='hidden']").val(id);
        $("#modal3 input[name='updatedModule']").val(module);
        $("#modal3 input[type='text']:last").val(libelle);
        console.log('Opened Modal');
    } else {
        console.log('Called Ajax');
        var idModule = $("#modal3 input[type='hidden']").val();
        var nomModule = $("#modal3 input[name='updatedModule']").val();
        var libelle = $("#modal3 input[type='text']:last").val();
        $.post({
            url: "http://127.0.0.1:8000/mainparts/module/" + idModule + "/updateModule",
            dataType: 'JSON',
            data: {
                "_token": $('#module-form input[name="_token"]').val(),
                "nomModule": nomModule,
                "libelle": libelle
            },
            success: function (result) {
                //console.log(result);
                if (result = 1) {
                    $("#tableModules").load("http://127.0.0.1:8000/mainparts/module #tableModules");
                    $('#modal3').modal('close');
                    console.log(result);
                } else if (result = -1) {
                    $('#modal3').modal('close');
                    console.log(result);
                } else {
                    $('#modal3').modal('close');
                    console.log(result);
                }
            }
        });
    }
}

//Delete le module
function onDeleteModule(id, deleteFromDb) {
    if (deleteFromDb == false) {
        $("#delete3 input[type='hidden']").val(id);
        console.log('delete modal opened');
        //console.log(id);
    } else {
        console.log('Delete with ajax');
        //Suppression d'un niveau avec ajax
        var idModule = $("#delete3 input[type='hidden']").val();
        $.ajax({
            url: "http://127.0.0.1:8000/mainparts/module/" + idModule + "/deleteModule",
            dataType: 'JSON',
            data: {
                "_token": $('#module-form input[name="_token"]').val(),
            },
            type: 'DELETE',
            success: function (result) {
                if (result = 1) {
                    $("#tableModules").load("http://127.0.0.1:8000/mainparts/module #tableModules");
                    $('#delete3').modal('close');
                    console.log(result);


                } else {
                    console.log(result);
                }
            }
        });
    }
}
