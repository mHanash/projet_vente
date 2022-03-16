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
                    <h4 class="page-title">Tous les personnels</h4>
                </div>
                <div class="col-7">
                    <div class="text-end upgrade-btn">
                        <a href="#" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                            class="mdi mdi-plus"></i> Ajouter un
                        nouveau agent</a>
                    </div>
                </div>
                </div>
            </div>
        <div class="card mt-2" style="overflow:auto">
            @if (count($personals)>0)
            <div class="card-body">
                <h5 class="card-title">Personnels</h5>
                <div class="table-responsive">
                    <table id="_config" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Téléphone</th>
                                <th>Role APP</th>
                                <th>Poste</th>
                                <th>email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($personals as $personal)
                                @php
                                    $i++
                                @endphp
                            <tr>
                                <td>{{ $personal->firstname }} </td>
                                <td>{{ $personal->lastname }} </td>
                                <td>{{ $personal->phone }}</td>
                                <td>
                                    @isset($personal->role)
                                    @if ($personal->role->name == 'all')
                                    Administrateur
                                    @else
                                        Vendeur
                                    @endif
                                    @endisset
                                </td>
                                <td>
                                    @isset($personal->title)
                                        {{ $personal->title->name }}
                                    @endisset
                                </td>
                                <td>{{ $personal->email }}</td>
                                <td>
                                    <form onsubmit="return confirm('Voulez-vous vraiment supprimer cet enregistrement ?')"
                                        action="{{ route('personal.delete',['id'=>$personal->id]) }}" method="POST" >
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $personal->id }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a title="Modifier" style="color: #fff"
                                            href="{{ route('personal.edit',['id'=>$personal->id]) }}"
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
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Téléphone</th>
                                <th>Role APP</th>
                                <th>Poste</th>
                                <th>email</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            @else
            <div class="alert alert-danger">
                <p style="margin-bottom: 0;">Aucun agent enregistrée</p>
            </div>
        @endif
    </div>
</div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('personal.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstname" class="form-label">Prénom</label>
                                <input type="text" class="form-control required" id="firstname" name="firstname">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lastname" class="form-label">Nom</label>
                                <input type="text" class="form-control required" id="lastname" name="lastname">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control required" id="phone" name="phone">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">email</label>
                                <input type="email" class="form-control required" id="email" name="email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="role" class="form-label">Poste</label>
                                    @if (count($titles)>0)
                                    <select name="title" id="" class="form-control required">
                                        @foreach ($titles as $title)
                                            <option value="{{ $title->id }}">{{ $title->name }}</option>
                                        @endforeach
                                    </select>
                                    @else
                                    <a href="{{ route('setting',['target'=>'title']) }}" class="btn btn-primary btn-sm mt-1" data-bs-toggle="modal"
                                    data-bs-target="#addType"><i class="mdi mdi-plus"></i> Nouveau
                                    poste</a>
                                    @endif
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Role application</label>
                                    @if (count($roles)>0)
                                    <select name="role" id="" class="form-control required">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                    @if (count($roles)<2))
                                    <a href="{{ route('setting',['target'=>'role']) }}" class="btn btn-primary btn-sm mt-1" data-bs-toggle="modal"
                                    data-bs-target="#addType"><i class="mdi mdi-plus"></i> Nouveau
                                    role</a>
                                    @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <p style="color: red;text-align:center">L'utilisateur est créé avec un mot de passe par defaut : <img src="{{ asset('assets/images/secret/pwd.png') }}" style="width:150px;height:30px"> </p>
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
