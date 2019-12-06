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
        if (propsNumber != responsesLength) {
            var $toastContent = $('<span>Atjibha ghir fkerrek wa3mmer</span>').add($('<button class="btn-flat toast-action">Undo</button>'));
            Materialize.toast($toastContent, 3000);
        } else {
            var count = $('[id^="response"]').length + 1;
            const newResponse = `
                <div id="response${count}" style="display: flex; align-items: center;">
                    <div class="input-field col s6 offset-s3">
                        <input type="text" name="proposition[]">
                        <label>Réponse ${count}</label>
                    </div>
                    <p class="">
                    <input id="hiden" type="hidden" name="reponse[${count - 1}]" value="0" >
                    <input name="reponse[${count - 1}]"  type="checkbox"  value="1" id="check${count}">
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
        var $toastContent = $('<span>Ooopps non non zid zid</span>').add($('<button class="btn-flat toast-action">Undo</button>'));
        Materialize.toast($toastContent, 3000);
    } else {
        $('#' + id).slideUp('fast', function () {
            $(this).remove();
            $('[id^="response"]').each(function (index) {
                $(this).attr({
                    id: 'response' + (index + 1)
                });
                $(`#response${index + 1} label:first`).text(`Réponse ${index + 1}`);
                $(`#response${index + 1} input[name^='reponse']`).attr({
                    name: `reponse[${index}]`,
                    id: function (index, oldValue) {
                        return oldValue.startsWith('check') ? `check${index}` : `hidden${index}`;
                    }
                });
                $(`#response${index + 1} a`).attr({
                    onclick: `return deleteResponse('response${index + 1}')`
                });
            });
        });
    }

}