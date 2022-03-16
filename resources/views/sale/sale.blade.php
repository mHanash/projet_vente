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
            @if(count($products)>0)
            <div class="card-body">
                <h5 class="card-title">Produits</h5>
                <div class="table-responsive">
                    <table id="_config" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Désignation</th>
                                <th>Emballage (Quatité)</th>
                                <th>Unité</th>
                                <th>Emballage</th>
                                <th>Origine</th>
                                <th>Poid (KG)</th>
                                <th>Type</th>
                                <th>Catégorie</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                        @php
                            $i++
                        @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->qteEmballage}}</td>
                                <td>{{$product->unit}}</td>
                                <td>{{$product->typeEmballage}}</td>
                                <td>{{$product->origine}}</td>
                                <td>{{$product->weight}}</td>
                                <td>{{$product->type->name}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>
                                    <form onsubmit="return confirm('Voulez-vous vraiment supprimer cet enregistrement ?')"
                                        action="{{ route('product.delete',['id'=>$product->id]) }}" method="POST" >
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a title="Modifier" style="color: #fff"
                                            href="{{ route('product.edit',['id'=>$product->id]) }}"
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
                                <th>Désignation</th>
                                <th>Emballage (Quatité)</th>
                                <th>Unité</th>
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
            @else
                <div class="alert alert-danger">
                                <p style="margin-bottom: 0;">Aucun produit enregistrée</p>
                            </div>
            @endif
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('product.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control" required id="name" name="name">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="typeEmballage" class="form-label">Type emballage</label>
                                <input type="text" class="form-control" required id="typeEmballage" name="typeEmballage">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="qteEmballage" class="form-label">Quatité</label>
                                <input type="number" class="form-control" required id="qteEmballage" name="qteEmballage">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="unit" class="form-label">Unité</label>
                                <select class="form-control" name="unit" id="unit">
                                    <option value="KG">Kilogramme(KG)</option>
                                    <option value="L">Litre(L)</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="origine" class="form-label">Origine</label>
                                <input type="text" class="form-control" required id="origine" name="origine">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="weight" class="form-label">Poids</label>
                                <input type="number" class="form-control" required id="weight" name="weight">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="type" class="form-label">Type des moteurs</label>
                                <select class="form-control" name="type">
                                @if(isset($types))
                                    @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="category" class="form-label">Catégorie</label>
                                <select class="form-control" name="category">
                                @if(isset($categories))
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                                </select>
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
