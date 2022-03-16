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
        <div class="page-breadcrumb">
            <div class="row align-items-center justify-content-center">
                <div class="col-5">
                    <h4 class="page-title" style="text-align: center">Modification du type</h4>
                </div>
            </div>
        </div>
        <div class="content-fluid">
            <div class="card mt-5">
                <form method="POST" action="{{ route('category.update',['id'=>$category->id]) }}" class="form-horizontal" >
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 text-end control-label col-form-label">Désignation</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" value="{{$category->name}}"/>
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

@endsection
