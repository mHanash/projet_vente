@extends('layout.main')

@section('content')
    <div style="height: 100vh; overflow:scroll">
        <div class="page-breadcrumb">
            <div class="row align-items-center justify-content-center">
                <div class="col-5">
                    <h4 class="page-title" style="text-align: center">Modifier les informations du personnel <br />
                        {{ 'Name' }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="content-fluid mb-3">
            <div class="card w-75 m-auto">
                <form class="form-horizontal">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="firstname" class="col-sm-3 text-end control-label col-form-label">Prénom</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="firstname" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname" class="col-sm-3 text-end control-label col-form-label">Nom</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="lastname" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 text-end control-label col-form-label">Téléphone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="origine" class="col-sm-3 text-end control-label col-form-label">Role</label>
                            <div class="col-sm-9">
                                <div class="col-sm-9">
                                    <select class="form-control" name="role">
                                        <option value="">opt 1</option>
                                        <option value="">opt 1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 text-end control-label col-form-label">Poste</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="title">
                                    <option value="">opt 1</option>
                                    <option value="">opt 1</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 text-end control-label col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="email" />
                            </div>
                        </div>
                        <hr>
                        <h4 class="text-center">Modifier mot de passe</h4>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 text-end control-label col-form-label">Nouveau mot de passe</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" required id="password" name="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirm" class="col-sm-3 text-end control-label col-form-label">Confirmez mot de passe</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" required id="password_confirm"
                                name="password_confirm">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-success mb-4 text-white btn-lg">
                                    Modifier
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
