<div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">Création des questions</h3>
            </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fluid">
            <form class="col-lg-12">
                <div class="row">
                    <div class="form-group input-group col-md-6 col-sm-12 col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Filière</span>
                        </div>
                        <select class="form-control">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </div>
                    <div class="form-group  input-group col-md-6 col-sm-12 col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Module</span>
                        </div>
                        <select class="form-control">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group input-group col-md-6 col-sm-12 col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Chapitre</span>
                        </div>
                        <select class="form-control">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="form-group input-group col-md-6 col-sm-12 col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Question</span>
                            </div>
                            <input type="text" class="form-control"
                                   aria-label="Text input with dropdown button">
                            <div class="input-group-append">
                                <button class="btn btn-secondary dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    Unique
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                    <a class="dropdown-item" href="#">Unique</a>
                                    <a class="dropdown-item" href="#">Choix multiple</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group input-group col-md-6 col-sm-12 col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Durée</span>
                        </div>
                        <input type="number" class="form-control" name="duration" min="0"/>
                        <div class="input-group-append">
                            <span class="input-group-text">s</span>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="input-group col-md-6 col-sm-12 col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Niveau</span>
                        </div>
                        <select class="form-control">
                            <option>Facile</option>
                            <option>Moyen</option>
                            <option>Difficile</option>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center align-items-baseline mb-2">
                    <div class="input-group col-md-6 col-sm-9 col-lg-6 col-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Réponse 1</span>
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
                <div class="d-flex justify-content-center">
                    <button class="btn btn-icon btn-circle btn-outline-brand btn-elevate">
                        <i class="fa fa-plus" style="font-size: 20px;"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
