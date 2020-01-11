$(function () {
    window.addEventListener('beforeunload', function (e) {
        e.preventDefault();
        e.returnValue = '';
    });
    $('body').attr('onload', 'return pauseTimer("event")');
    $.post({
        async: true,
        data: {
            '_token': $('#qcm-form input[name="_token"]').val(),
            'data': 'user_id'
        },
        dataType: 'JSON',
        url: '{{route("registerUser")}}'
    });
});

function changeQuestion(id) {
    $('[id^="question"]').each(function (index) {
        if (parseInt(id.substr(8)) !== index) {
            $('#pg' + index).addClass('waves-effect');
            $('#pg' + index).removeClass('active');
            $(this).hide();
        } else {
            $(this).show();
            $('#pg' + index).removeClass('waves-effect');
            $('#pg' + index).addClass('active');
        }
    });
}

function answerQuestion(index) {
    var totalQuestions = $('[id^=question]').length;
    var answeredQuestions = $('.answered').length;

    if ($(`#question${index} input:last`).attr('type') === 'checkbox') {
        var checkedProposotions = 0;
        $(`#question${index} input[type='checkbox']`).each(function (index, elem) {
            if ($(elem).is(':checked')) {
                checkedProposotions++;
            }
        });
        if (checkedProposotions == 0) {
            $('#pg' + index).removeClass('answered waves-effect');
            $('#pg' + index + ' a').removeClass('white-text');
            $('#pg' + index + ' a').removeClass('black-text');
            $('#pg' + index).addClass('active');
            answeredQuestions--;
            $('.progress .determinate').css('width', (answeredQuestions * 100 / totalQuestions) + "%");
            $('#answered-questions').text(answeredQuestions + '/' + totalQuestions);
            $('#qcm-form button').attr('disabled', true);
            return;
        }
    }
    $('#pg' + index).removeClass('active waves-effect');
    $('#pg' + index).addClass('answered');
    answeredQuestions = $('.answered').length;
    $('#pg' + index + ' a').addClass('white-text');
    $('.progress .determinate').css('width', (answeredQuestions * 100 / totalQuestions) + "%");
    $('#answered-questions').text(answeredQuestions + '/' + totalQuestions);

    if (totalQuestions == answeredQuestions) {
        $('#qcm-form button').removeAttr('disabled');
    }
}

function submitQCM(e = event) {
    if (e != null) {
        e.preventDefault();
    }
    var form = $('#qcm-form');
    var questions = [];
    var i = 0;
    while (i < form.serializeArray().length) {
        var row = form.serializeArray()[i];
        if (row.name.endsWith('[\'id\']')) {
            var question = {
                question_id: parseInt(row.value),
                propositions: []
            };
            questions.push({ ...question });
        } else {
            questions.forEach(function (question, index) {
                if (index === parseInt(row.name.replace(/[^0-9]/g, ""))) {
                    question.propositions.push(parseInt(row.value));
                }
            });
        }
        i++;
    }
    questions.sort(function (q1, q2) { return q1.question_id - q2.question_id; });
    $.post({
        url: form.data('route'),
        data: {
            "_token": $('#qcm-form input[name="_token"]').val(),
            "data": questions
        },
        dataType: 'JSON',
        beforeSend: function () {
            console.log("before send");
        },
        error: function (e) {
            console.log(e);
        },
        success: function (data) {
            console.log(data);
        }
    });
}