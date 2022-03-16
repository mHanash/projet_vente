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
                    Option
                    @isset($target)
                    @if ($target=='role')
                        Role
                    @else
                        Poste
                    @endif
                    @endisset
                </h4>
            </div>
            <div class="col-7">
                @if ($target=='role')
                @if (count($options)<2)
                <div class="text-end upgrade-btn">
                    <a href="#" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                        class="mdi mdi-plus"></i>Nouvel enregistrement</a>
                </div>
                @endif
                @else
                <div class="text-end upgrade-btn">
                    <a href="#" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                        class="mdi mdi-plus"></i>Nouvel enregistrement</a>
                </div>
                @endif
            </div>
            </div>
        </div>
    <div class="card mt-2" style="overflow:auto">
        @if (count($options)>0)
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
                        @foreach ($options as $option)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                @if ($target=='role')
                                    @if ($option->name=='all')
                                        Administrateur
                                    @else
                                        Vendeur
                                    @endif
                                @else
                                    {{ $option->name }}
                                @endif
                            </td>
                            <td>
                                <form onsubmit="return confirm('Voulez-vous vraiment supprimer cet enregistrement ?')"
                                    action="{{ route('setting.delete',['id'=>$option->id,'target'=>$target]) }}" method="POST" >
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $option->id }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    @if ($target=='title')
                                    <a title="Modifier" style="color: #fff"
                                            href="{{ route('setting.edit',['id'=>$option->id]) }}"
                                            class="btn btn-success btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                    @endif
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
                    <p style="margin-bottom: 0;">Aucune option enregistrée</p>
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
            <form method="POST" action="{{ route('setting.store',['target'=>$target]) }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Désignation</label>
                            @if ($target=='role')
                            <select  class="form-control" required id="name" name="name">
                                <option value="all">Administrateur</option>
                                <option value="simple">Vendeur</option>
                            </select>
                            @else
                            <input type="text" name="name" id="name" class="form-control">
                            @endif
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
