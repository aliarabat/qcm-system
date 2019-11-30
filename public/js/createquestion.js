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
        var count = $('[id^="response"]').length + 1;
        const newResponse = `
                <div id="response${count}" style="display: flex; align-items: center;">
                    <div class="input-field col s6 offset-s3">
                        <input type="text" required name="response[${count-1}][suggestion]">
                        <label>Réponse ${count}</label>
                    </div>
                    <p class="">
                        <input type="checkbox" id="check${count}" name="response[${count-1}][checked] " />
                        <label for="check${count}"></label>
                    </p>
                    <span class="red-text" style="cursor: pointer">
                        <i class="material-icons ">delete</i>
                    </span>
                </div>`;
        $("[id^='response']:last").after(newResponse);
    });

    $("#question-form").submit(function (e) {
        console.log($(this));
        e.preventDefault();
    });
});