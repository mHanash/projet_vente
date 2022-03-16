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
            <div class="row align-items-center">
                <div class="col-5">
                    <h4 class="page-title">
                        Nos dépots
                    </h4>
                </div>
                <div class="col-7">
                    {{-- @if (count($stores) < 2) --}}
                        <div class="text-end upgrade-btn">
                            <a href="#" class="btn btn-success text-white" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"><i class="mdi mdi-plus"></i>Nouvel enregistrement</a>
                        </div>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
        <div class="card mt-2" style="overflow:auto">
            @if (count($stores) > 0)
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Adresse</th>
                                    <th>Contact</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stores as $store)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $store->name }}</td>
                                        <td>{{ $store->address }}</td>
                                        <td>{{ $store->contact }}</td>
                                        <td>
                                            <form
                                                onsubmit="return confirm('Voulez-vous vraiment supprimer cet enregistrement ?')"
                                                action="{{ route('store.delete', ['id' => $store->id]) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $store->id }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <a title="Modifier" style="color: #fff"
                                                href="{{ route('store.edit',['id'=>$store->id, 'name'=>$store->name]) }}"
                                                class="btn btn-success btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                                <button title="Supprimer" style="color: #fff"
                                                    class="btn btn-danger btn-xs"><i class="far fa-trash-alt"></i></button>
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
                    <p style="margin-bottom: 0;">Aucun dépot enregistré</p>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouvelle option</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('store.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Désignation</label>
                                <input type="text" name="name" id="name" required class="form-control">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Adresse</label>
                                <input type="text" name="address" id="address" required class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="contact" class="form-label">Contact</label>
                                <input type="phone" name="contact" id="contact" required class="form-control">
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
