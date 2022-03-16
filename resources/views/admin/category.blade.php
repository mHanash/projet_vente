@php
    $i=0;
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
                <h4 class="page-title">
                    Catégories des produits
                </h4>
            </div>
            <div class="col-7">
                <div class="text-end upgrade-btn">
                    <a href="#" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                        class="mdi mdi-plus"></i>Nouvel enregistrement</a>
                </div>
            </div>
            </div>
        </div>
    <div class="card mt-2" style="overflow:auto">
        @if (count($categories)>0)
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Désignation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                <form onsubmit="return confirm('Voulez-vous vraiment supprimer cet enregistrement ?')"
                                    action="{{ route('category.delete',['id'=>$category->id]) }}" method="POST" >
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $category->id }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <a title="Modifier" style="color: #fff"
                                            href="{{ route('category.edit',['id'=>$category->id]) }}"
                                            class="btn btn-success btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                    <button title="Supprimer" style="color: #fff" class="btn btn-danger btn-xs"><i
                                            class="far fa-trash-alt"></i></button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
                <div class="alert alert-danger">
                                <p style="margin-bottom: 0;">Aucune categorie enregistrée</p>
                            </div>
        @endif
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nouveau type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('category.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Désignation</label>
                            <input type="text" name="name" id="name" class="form-control">
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
