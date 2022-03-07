@extends('layout.main')

@section('content')
    <div style="height:100vh;overflow:scroll">
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-5">
                    <h4 class="page-title">Tous les produits</h4>
                </div>
                <div class="col-7">
                    <div class="text-end upgrade-btn">
                        <a href="#" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                            class="mdi mdi-plus"></i> Ajouter un
                        nouveau produit</a>
                    </div>
                </div>
                </div>
            </div>
        <div class="card mt-2" style="overflow:auto">
            <div class="card-body">
                <h5 class="card-title">Produits</h5>
                <div class="table-responsive">
                    <table id="_config" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Désignation</th>
                                <th>Emballage (Quatité)</th>
                                <th>Emballage</th>
                                <th>Origine</th>
                                <th>Poid (KG)</th>
                                <th>Type</th>
                                <th>Catégorie</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>Timothy </td>
                                <td>Office </td>
                                <td>London</td>
                                <td>37</td>
                                <td>2008/12/11</td>
                                <td>2008/12/11</td>
                                <td>2008/12/11</td>
                                <td>2008/12/11</td>
                                <td>
                                    <form onsubmit="return confirm('Voulez-vous vraiment supprimer cet enregistrement ?')"
                                        action="" method="POST" >
                                        @csrf
                                        <input type="hidden" name="id" value="">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a title="Modifier" style="color: #fff"
                                            href="{{ route('product.edit',['id'=>1]) }}"
                                            class="btn btn-success btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                        <button title="Supprimer" style="color: #fff" class="btn btn-danger btn-xs"><i
                                                class="far fa-trash-alt"></i></button>
                                    </form>

                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Code</th>
                                <th>Désignation</th>
                                <th>Emballage (Quatité)</th>
                                <th>Emballage</th>
                                <th>Origine</th>
                                <th>Poid (KG)</th>
                                <th>Type</th>
                                <th>Catégorie</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Noms complet</label>
                                <input type="text" class="form-control" required id="name" name="name">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">email</label>
                                <input type="email" class="form-control" required id="email" name="email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" required id="phone" name="phone">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Adresse</label>
                                <input type="text" class="form-control" required id="address" name="address">
                            </div>
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
