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
                            $("#tableNiveaux").load("http://127.0.0.1:8000/mainparts/niveau/niveaux #tableNiveaux");
                        } else {
                            var $toastContent = $("<span>" + response + "</span>").add($('<button class="btn-flat toast-action">Annuler</button>'));
                            Materialize.toast($toastContent, 3000);
                        }
                    }
                });


            }
        });
    }


});
