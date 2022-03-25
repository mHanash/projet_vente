
@extends('layout.main')

@section('content')
    <div style="height:100vh; overflow:hidden ">
        <div class="row justify-content-center">
            <img style="width: 200px;height:200px; margin:1em 0 0 -4em" src="{{ asset('assets/images/telogo.svg') }}" alt="">
            <h1 style="text-align: center">Gestion de vente </h1>
            <p style="text-align: center">Espace de travail pour vendeur</p>
        </div>
        <div class="row mt-md-5 justify-content-center">
            <div class="col-md-4"></div>
            <div class="col-md-2 text-center">
                <a href="{{ route('sale') }}" class="btn btn-dark btn-md mt-3">Enregistrer une vente</a>
            </div>
            <div class="col-md-2 text-center">
                <a href="{{ route('sale.show') }}" class="btn btn-dark btn-md mt-3">Voir les ventes</a>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
@endsection
