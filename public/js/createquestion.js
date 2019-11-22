$(function(){
    $("#add-button button").on('click', function (e) {
        e.preventDefault();
        var count = $('[id^="response"]').length+1;
        const ddd=`
                <div class="row justify-content-center align-items-baseline mb-2" id="response`+count+`">
                    <div class="input-group col-md-6 col-sm-9 col-lg-6 col-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Réponse `+count+`</span>
                        </div>
                        <input type="text" class="form-control"
                               aria-label="Text input with checkbox">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <label
                                    class="kt-checkbox kt-checkbox--single kt-checkbox--primary">
                                    <input type="checkbox" checked="">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <button class="btn btn-circle btn-outline-danger btn-icon btn-elevate">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
        `;
        $("#add-button").before(ddd);
    });
});