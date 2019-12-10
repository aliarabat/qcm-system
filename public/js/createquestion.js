$(function () {
    $("#arrow-forward").on('click', function (e) {
        e.preventDefault();
        $("#question-create-form1").slideToggle('2000');
        $("#question-create-form2").slideToggle('2000');
    });
    $("#arrow-back").on('click', function (e) {
        e.preventDefault();
        $("#question-create-form1").slideToggle('2000');
        $("#question-create-form2").slideToggle('2000');
    });
    $("#add-button button").on('click', function (e) {
        e.preventDefault();
        const responsesLength = $("[id^='response']").length;
        var propsNumber = 0;
        $("input[name='proposition[]']").each(function (i, el) {
            if ($(el).val() !== '') {
                propsNumber++;
            }
        });
        console.log('reponses', responsesLength);
        console.log('propsNumber', propsNumber);
        if (propsNumber != responsesLength) {
            var $toastContent = $('<span>Remplir toutes les réponses correspondantes</span>').add($('<button class="btn-flat toast-action">Annuler</button>'));
            Materialize.toast($toastContent, 3000);
        } else {
            var count = $('[id^="response"]').length;
            const newResponse = `
                <div id="response${count}" style="display: flex; align-items: center;">
                    <div class="input-field col s6 offset-s3">
                        <input type="text" name="proposition[]">
                        <label>Réponse ${count + 1}</label>
                    </div>
                    <p class="">
                    <input id="hidden${count}" type="hidden" name="reponse[${count}]" value="0" >
                    <input name="reponse[${count}]"  type="checkbox"  value="1" id="check${count}">
                        <label for="check${count}"></label>
                    </p>
                    <a href="#" onclick="return deleteResponse('response${count}')" class="red-text text-accent-4" style="cursor: pointer">
                        <i class="material-icons ">delete</i>
                    </a>
                </div>`;
            $("[id^='response']:last").after(newResponse);
        }
    });

});

function deleteResponse(id) {
    if ($('[id^="response"]').length === 1) {
        var $toastContent = $('<span>Vous ne pouvez supprimer tous les réponses</span>').add($('<button class="btn-flat toast-action">Annuler</button>'));
        Materialize.toast($toastContent, 3000);
    } else {
        $('#' + id).slideUp('fast', function () {
            $(this).remove();
            $('[id^="response"]').each(function (index) {
                $(this).attr({
                    id: 'response' + index
                });
                $(`#response${index} label:first`).text(`Réponse ${index + 1}`);
                $(`#response${index} label:last`).attr({
                    for: `check${index}`
                });
                $(`#response${index} input[name^='reponse']:first`).attr({
                    name: `reponse[${index}]`,
                    id: `hidden${index}`
                });
                $(`#response${index} input:last`).attr({
                    name: `reponse[${index}]`,
                    id: `check${index}`
                });
                $(`#response${index} a`).attr({
                    onclick: `return deleteResponse('response${index}')`
                });
            });
        });
    }

}