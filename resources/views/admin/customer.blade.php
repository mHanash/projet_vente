@php
    $i=0;
@endphp
@extends('layout.main')

@section('content')
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
    <div style="height:100vh;overflow:scroll">
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-5">
                    <h4 class="page-title">Tous les clients</h4>
                </div>
                <div class="col-7">
                    <div class="text-end upgrade-btn">
                        <a href="#" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                            class="mdi mdi-plus"></i> Ajouter un
                            nouveau client</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-2" style="overflow:auto">
            @if (count($customers)>0)
            <div class="card-body">
                <h5 class="card-title">Personnels</h5>
                <div class="table-responsive">
                    <table id="_config" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Téléphone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $customer->firstname }}</td>
                                <td>{{ $customer->lastname }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>
                                    <form onsubmit="return confirm('Voulez-vous vraiment supprimer cet enregistrement ?')"
                                        action="{{ route('customer.delete',['id'=>$customer->id]) }}" method="POST" >
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $customer->id }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a title="Modifier" style="color: #fff"
                                            href="{{ route('customer.edit',['id'=>$customer->id]) }}"
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
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Téléphone</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        @else
        <div class="alert alert-danger">
            <p style="margin-bottom: 0;">Aucun client enregistrée</p>
        </div>
        @endif
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
