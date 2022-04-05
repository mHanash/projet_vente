@php
    $i = 0;
    $products_tab = [];
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
        <form action="{{ route('sale.store') }}" method="POST">
            @csrf
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-4">
                    <h4 class="page-title">Tous les produits disponible</h4>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="mt-2">Information du client</h5>
                        </div>
                        <div class="col-6">
                            <select name="customer" class="form-control">
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->firstname }} {{ $customer->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="text-end upgrade-btn">
                        <a href="#" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                            class="mdi mdi-plus"></i>Nouveau client</a>
                    </div>
                </div>
                </div>
            </div>
        <div class="card mt-2" style="overflow:auto">
            @if(count($products)>0)
            <div class="card-body">
                <div class="card-title">
                </div>
                <div class="table-responsive">
                        <table id="_config" class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>Choix</th>
                                    <th>Code</th>
                                    <th>Désignation</th>
                                    <th>Emballage</th>
                                    <th>Quantité</th>
                                </tr>
                            </thead>
                            <tbody class="customtable">
                            @foreach ($products as $product)
                                <tr>
                                    <th>
                                        @php
                                            $products_tab[$i-1] = $product->id;
                                        @endphp
                                        <label class="customcheckbox mb-3">
                                          <input type="checkbox" id="listCheckbox" name="product{{ $i }}" value="{{ $product->id }}"/>
                                          <span class="checkmark"></span>
                                        </label>
                                      </th>
                                    <td>
                                        @foreach ($product->stores as $store)
                                            @if ($store->name =='Limete')
                                            {{ $store->pivot->code }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->qteEmballage}} {{$product->unit}}</td>
                                    <td><input type="number" class="form-control" required name="qte{{ $i }}"></td>
                                </tr>
                                @php
                                    $i++
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row" >
                        <div class="col-md-5"></div>
                        <div class="col-md-2">
                            <div class="row">
                                <button class="btn btn-lg btn-primary text-white" type="submit">Enregistrer</button>
                            </div>
                        </div>
                        <div class="col-md-5"></div>
                    </div>
                </div>
                <div style='display: none'>
                    <select type="hidden" name="products[]" multiple>
                        @foreach ($products_tab as $item)
                        <option value="{{ $item }}" selected></option>
                        @endforeach
                    </select>
                </div>
            </form>
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
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un nouveau client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('customer.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstname" class="form-label">Prénom</label>
                                <input type="text" class="form-control" required id="firstname" name="firstname">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lastname" class="form-label">Nom</label>
                                <input type="text" class="form-control" required id="lastname" name="lastname">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" required id="phone" name="phone">
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
