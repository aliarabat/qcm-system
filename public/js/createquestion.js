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
    $a = 1;
    $("#add-button button").on('click', function (e) {
        e.preventDefault();
        var count = $('[id^="response"]').length + 1;
         
        var rep = $a++; 
        const newResponse = `
                <div id="response`+count+ `" style="display: flex; align-items: center;">
                    <div class="input-field col s6 offset-s3">
                        <input type="text" name="proposition[]">
                        <label>Réponse `+count+`</label>
                    </div>
                    <p class="">
                    <input id="hiden" type="hidden" name="reponse[`+rep+`]" value="0" >
                    <input name="reponse[`+rep+`]"  type="checkbox"  value="1" id="check`+count+ `">
                        <label for="check`+count+ `"></label>
                    </p>
                    <span class="red-text" style="cursor: pointer">
                        <i class="material-icons ">delete</i>
                    </span>
                </div>`;
        $("[id^='response']:last").after(newResponse);
    });


});