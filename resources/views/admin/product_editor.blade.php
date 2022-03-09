@extends('layout.main')

@section('content')
    <div style="height: 100vh; overflow:scroll">
        <div class="page-breadcrumb">
            <div class="row align-items-center justify-content-center">
                <div class="col-5">
                    <h4 class="page-title" style="text-align: center">Modifier les informations du produit <br />
                        {{ $product->name }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="content-fluid">
            <div class="card">
                <form method="POST" action="{{ route('product.update') }}" class="form-horizontal" >
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 text-end control-label col-form-label">Nom du produit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" value="{{$product->name}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="qteEmballage" class="col-sm-3 text-end control-label col-form-label">Emballage
                                (Quantité)</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="qteEmballage" value="{{$product->qteEmballage}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="typeEmballage" class="col-sm-3 text-end control-label col-form-label">Emballage</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="typeEmballage" value="{{$product->typeEmballage}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="origine" class="col-sm-3 text-end control-label col-form-label">Origine</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="origine" value="{{$product->origine}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="weight" class="col-sm-3 text-end control-label col-form-label">Poids (KG)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="weight" value="{{$product->weight}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-3 text-end control-label col-form-label">Type</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="type">
                                @if(isset($types))
                                    @foreach ($types as $type)
                                    @if ( $product->type->id == $type->id)
                                    <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                                    @else
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endif
                                    @endforeach
                                @endif
                                </select>
                                <a href="#" class="btn btn-primary btn-sm mt-1" data-bs-toggle="modal"
                                    data-bs-target="#addType"><i class="mdi mdi-plus"></i> Nouveau
                                    type</a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-sm-3 text-end control-label col-form-label">Catégorie</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="type">
                                @if(isset($categories))
                                    @foreach ($categories as $category)
                                    @if ($product->category->id == $category->id )
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                    @endforeach
                                @endif
                                </select>
                                <a href="#" class="btn btn-primary btn-sm mt-1" data-bs-toggle="modal"
                                    data-bs-target="#addCategory"><i class="mdi mdi-plus"></i> Nouvelle Catégorie
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-4">
                                <button class="btn btn-success mb-4 text-white">
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
