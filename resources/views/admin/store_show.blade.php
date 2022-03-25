@php
    $i = 0;
@endphp
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
            <div class="row align-items-center mb-2">
                <div class="col-5">
                    <h4 class="page-title">
                        Dépôt de {{ $store->name }}
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
        @if (count($store->products)>0)
        <div class="card mt-2" style="overflow:auto">
            <div class="page-breadcrumb">
                @php
                    $i++;
                @endphp
                <div class="card-body">
                    <h5 class="card-title">Produits</h5>
                    <div class="table-responsive">
                        <table id="_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Désignation</th>
                                    <th>Emballage (Quatité)</th>
                                    <th>Poid (KG)</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($store->products as $product)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $product->pivot->code}}</td>
                                    <td>{{ $product->name}}</td>
                                    <td>{{ $product->qteEmballage }} {{ $product->unit }} </td>
                                    <td>{{ $product->weight }}</td>
                                    <td>{{ $product->type->name }}</td>
                                    <td>
                                        <form onsubmit="return confirm('Voulez-vous vraiment supprimer cet enregistrement ?')"
                                            action="{{ route('store.delete.product',['name'=>$store->name,'id'=>$store->id]) }}" method="POST" >
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $store->id }}">
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a title="Modifier" style="color: #fff"
                                                href="{{ route('store.edit.product',['id'=>$store->id,'product'=>$product->id]) }}"
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
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Désignation</th>
                                    <th>Emballage (Quatité)</th>
                                    <th>Poid (KG)</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-danger">
                <p style="margin-bottom: 0;">Pas d'affectation de produits dans ce dépôt</p>
            </div>
            @endif
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('store.store.product',['id'=>$store->id]) }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $store->id }}">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Noms du produit</label>
                                <select name="product_id" id="product_id" class="form-control">
                                    @if (count($products)>0)
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                    @else
                                        <option value="0">Aucun produit</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="code" class="form-label">Code</label>
                                <input type="number" class="form-control" required id="code" name="code">
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
