
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
            url: "http://127.0.0.1:8000/mainparts/niveau/niveaux/" + idNiveau + "/updateNiveau",
            dataType: 'JSON',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "nomNiveau": nomNiveau,
                "typeNiveau": typeNiveau
            },
            success: function (result) {
                console.log(result);
                if (result = 1) {
                    $("#tableNiveaux").load("http://127.0.0.1:8000/mainparts/niveau/niveaux #tableNiveaux");
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
            url: "http://127.0.0.1:8000/mainparts/niveau/niveaux/" + idNiveau + "/deleteNiveau",
            dataType: 'JSON',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            type: 'DELETE',
            success: function (result) {
                console.log(result);
                if (result = 1) {
                    $("#tableNiveaux").load("http://127.0.0.1:8000/mainparts/niveau/niveaux #tableNiveaux");
                    $('#delete1').modal('close');
                    console.log(1);
                } else {
                    console.log(-1);
                }
            }
        });
    }
}
