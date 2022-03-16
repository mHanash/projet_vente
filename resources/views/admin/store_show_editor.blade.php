@extends('layout.main')
@section('content')
<div style="height: 100vh; overflow:scroll">
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
            <form class="form-horizontal" method="POST" action="{{ route('store.update.product',['id'=>$store->id,'product'=>$product->id]) }}">
                @csrf
                <div class="card-body">
                    <input type="hidden" name="store" value="{{ $store->id }}">
                    <input type="hidden" name="id" value="{{ $product->id }}">
                   <div class="form-group row">
                        <label for="code" class="col-sm-3 text-end control-label col-form-label">Prix pièce</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" required name="code" value="{{ $product->pivot->code }}" />
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success mb-4 text-white">
                                Modifier
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
