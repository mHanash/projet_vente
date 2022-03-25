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
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-4">
                    <h4 class="page-title">Tous les produits disponible</h4>
                </div>
            </div>
            <div class="card mt-2" style="overflow:auto">
                @if (count($sales) > 0)
                    <div class="card-body">
                        <div class="card-title">
                        </div>
                        <div class="table-responsive">
                            <table id="_config" class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Désignation</th>
                                        <th>Emballage</th>
                                        <th>Quantité</th>
                                        <th>Montant</th>
                                    </tr>
                                </thead>
                                <tbody class="customtable">
                                    @foreach ($sales as $sale)
                                        @if (isset($sale->products))
                                            @foreach ($sale->products as $product)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $sale->created_at }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->qteEmballage }} {{ $product->unit }}</td>
                                                    <td>{{ $product->pivot->qte }}</td>
                                                    <td>{{ $sale->amount }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger">
                        <p style="margin-bottom: 0;">Aucun produit vendu</p>
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
