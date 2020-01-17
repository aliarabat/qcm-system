$(function () {
    if ($("#niveau-form").length > 0) {
        $("#niveau-form").validate({

            rules: {
                niveau: {
                    required: true,
                    maxlength: 60,
                },
                type: {
                    required: true,
                    maxlength: 100,
                },
            },
            messages: {
                niveau: {
                    required: "Veuillez saisir le niveau",
                },
                type: {
                    required: "Veuillez saisir le type du niveau",
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
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#niveauSubmit').html('Sending..');
                $.ajax({
                    url: $('#niveauSubmit').val(),
                    type: "POST",
                    data: $('#niveau-form').serialize(),
                    success: function (response) {
                        $('#niveauSubmit').html('Créer');
                        $('#res_message').show();
                        $('#res_message').html(response.msg);
                        $('#msg_div').removeClass('d-none');
                        $('#niveauIn').val("");
                        $('#typeIn').val("");
                        setTimeout(function () {
                            $('#res_message').hide();
                            $('#msg_div').hide();
                        }, 10000);
                        if (response == "Le Niveau a été créé") {
                            var $toastContent = $("<span>" + response + "</span>").add($('<button class="btn-flat toast-action">Annuler</button>'));
                            Materialize.toast($toastContent, 3000);
                            $("#tableNiveaux").load("http://127.0.0.1:8000/mainparts/niveau #tableNiveaux");
                        } else {
                            var $toastContent = $("<span>" + response + "</span>").add($('<button class="btn-flat toast-action">Annuler</button>'));
                            Materialize.toast($toastContent, 3000);
                        }
                    }
                });


            }
        });
    }


})

//Update niveau
function onUpdateNiveau(id, niveau, type, updateInDb) {
    if (updateInDb == false) {
        $("#modal1 input[type='hidden']").val(id);
        $("#modal1 input[type='text']:first").val(niveau);
        $("#modal1 input[type='text']:last").val(type);
        console.log('Opened Modal');
    } else {
        console.log('Called Ajax');
        //mettre a jour avec Ajax
        var idNiveau = $("#modal1 input[type='hidden']").val();
        var nomNiveau = $("#modal1 input[type='text']:first").val();
        var typeNiveau = $("#modal1 input[type='text']:last").val();
        $.post({
            url: "http://127.0.0.1:8000/mainparts/niveau/" + idNiveau + "/updateNiveau",
            dataType: 'JSON',
            data: {
                "_token": $('#niveau-form input[name="_token"]').val(),
                "nomNiveau": nomNiveau,
                "typeNiveau": typeNiveau
            },
            success: function (result) {
                console.log(result);
                if (result = 1) {
                    $("#tableNiveaux").load("http://127.0.0.1:8000/mainparts/niveau #tableNiveaux");
                    $('#modal1').modal('close');
                    console.log(1);
                } else if (result = -1) {
                    console.log(-1);
                } else {
                    console.log(-2);
                }
            }
        });
    }
}

//Delete le niveau
function onDeleteNiveau(id, deleteFromDb) {
    if (deleteFromDb == false) {
        $("#delete1 input[type='hidden']").val(id);
        console.log('delete modal opened');
    } else {
        console.log('Delete with ajax');
        //Suppression d'un niveau avec ajax
        var idNiveau = $("#delete1 input[type='hidden']").val();

        $.ajax({
            url: "http://127.0.0.1:8000/mainparts/niveau/" + idNiveau + "/deleteNiveau",
            dataType: 'JSON',
            data: {
                "_token": $('#niveau-form input[name="_token"]').val()
            },
            type: 'DELETE',
            success: function (result) {
                console.log(result);
                if (result = 1) {
                    $("#tableNiveaux").load("http://127.0.0.1:8000/mainparts/niveau #tableNiveaux");
                    $('#delete1').modal('close');
                    console.log(1);
                } else {
                    console.log(-1);
                }
            }
        });
    }
}
