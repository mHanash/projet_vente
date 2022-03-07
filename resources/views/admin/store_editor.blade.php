@extends('layout.main')
@section('content')
<div style="height: 100vh; overflow:scroll">
    <div class="page-breadcrumb">
        <div class="row align-items-center justify-content-center">
            <div class="col-5">
                <h4 class="page-title" style="text-align: center">Modifier le code du produit <br />
                    {{ 'Name' }}
                </h4>
            </div>
        </div>
    </div>
    <div class="content-fluid">
        <div class="card">
            <form class="form-horizontal">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="code" class="col-sm-3 text-end control-label col-form-label">Code</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="code" />
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-success mb-4 text-white">
                                Modifier
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addType" tabindex="-1" aria-labelledby="addTypeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un nouveau type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 coclientl-md-12">
                            <label for="name" class="form-label">Nom du logiciel</label>
                            <input type="text" class="form-control" required id="name" name="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
