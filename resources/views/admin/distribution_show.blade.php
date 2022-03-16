@extends('layout.main')

@section('content')
    <div style="height:100vh;overflow:scroll">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Succès ! </strong>{{ session()->get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('fail'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erreur ! </strong>{{ session()->get('fail') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Erreur ! </strong>{{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endforeach
        @endif
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-5">
                    <h4 class="page-title">
                        @if ($distribution->name == 'RKIN')
                            Réseau Kinshasa
                        @elseif ($distribution->name == 'RHKIN')
                            Réseau Hors Kinshasa
                        @endif
                    </h4>
                </div>
                <div class="col-7">
                    <div class="text-end upgrade-btn">
                        <a href="#" class="btn btn-success text-white" data-bs-toggle="modal"
                            data-bs-target="#exampleModal"><i class="mdi mdi-plus"></i>Affecter un produit</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-2" style="overflow:auto">
            @if (count($distribution->products)>0)
            <div class="card-body">
                <h5 class="card-title">Produits</h5>
                <div class="table-responsive">
                    <table id="_config" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Désignation</th>
                                <th>Emballage (Quatité)</th>
                                <th>Poid (KG)</th>
                                <th>Type</th>
                                <th>Prix Emballage</th>
                                <th>Prix pièce</th>
                                <th>Prix de vente (public)</th>
                                <th>Prix Hors TVA</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($distribution->products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->qteEmballage }} {{ $product->unit }}</td>
                                <td>{{ $product->weight }}</td>
                                <td>{{ $product->type->name }}</td>
                                <td>{{ ($product->pivot->priceUnit)*($product->qteEmballage) }}</td>
                                <td>{{ $product->pivot->priceUnit }}</td>
                                <td>{{ $product->pivot->priceUnitPublic }}</td>
                                <td>{{ $product->pivot->priceHTVA }}</td>
                                <td>
                                    <form onsubmit="return confirm('Voulez-vous vraiment supprimer cet enregistrement ?')"
                                        action="{{ route('distribution.delete.product',['name'=>$distribution->name,'id'=>$distribution->id]) }}" method="POST" >
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $distribution->id }}">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a title="Modifier" style="color: #fff"
                                            href="{{ route('distribution.edit',['name'=>$distribution->name,'id'=>$distribution->id,'product_id'=>$product->id]) }}"
                                            class="btn btn-success btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                        <button title="Supprimer" style="color: #fff" class="btn btn-danger btn-xs"><i
                                                class="far fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Désignation</th>
                                <th>Emballage (Quatité)</th>
                                <th>Poid (KG)</th>
                                <th>Type</th>
                                <th>Prix Emballage</th>
                                <th>Prix pièce</th>
                                <th>Prix de vente (public)</th>
                                <th>Prix Hors TVA</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            @else
            <div class="alert alert-danger">
                <p style="margin-bottom: 0;">Pas d'affectation de produits pour ce réseau</p>
            </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Affecter un produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('distribution.product',['id'=>$distribution->id]) }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{ $distribution->id }}">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Noms du produit</label>
                                <select name="product" id="product" class="form-control">
                                    @if (count($products)>0)
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                    @else
                                        Aucun produit
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="priceUnit" class="form-label">Prix par pièce</label>
                                <input type="number" class="form-control" required id="priceUnit" name="priceUnit">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="priceUnitPublic" class="form-label">Prix de vente public</label>
                                <input type="number" class="form-control" required id="priceUnitPublic" name="priceUnitPublic">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="priceHTVA" class="form-label">Prix hors TVA</label>
                                <input type="number" class="form-control" required id="priceHTVA" name="priceHTVA">
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
