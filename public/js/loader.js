function showLoader(id) {
    var preLoader = `<div class="preloader-wrapper small active" style="width: 30px; height: 30px; margin-top: 2.5px;">
                            <div class="spinner-layer" style="border-color: #ff5722 !important;">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div><div class="gap-patch">
                                <div class="circle"></div>
                            </div><div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                            </div>
                        </div>`;


    $(id).text('');
    $(id).removeClass('btn-flat');
    $(id).addClass('disabled');

    $(id).append(preLoader);

}

function hideLoader(id, buttonLabel, icon = null) {
    $(id).text(buttonLabel);
    $(id).removeClass('disabled');
    $(id).addClass('btn-flat');
    if (icon != null) {
        var html = `<i class="material-icons ${buttonLabel != '' ? 'left' : ''}">` + icon + '</i>'
        $(id).prepend(html);
    }
}