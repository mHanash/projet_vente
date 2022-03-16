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
                    <h4 class="page-title" style="text-align: center">Modifier les informations du personnel <br />
                        {{ $user->firstname }} {{ $user->lastname }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="content-fluid mb-3">
            <div class="card w-75 m-auto">
                <form class="form-horizontal" method="POST" action="{{ route('personal.update') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <input type="hidden" class="form-control" name="id" value="{{ $user->id }}">

                            <label for="firstname" class="col-sm-3 text-end control-label col-form-label">Prénom</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="firstname"
                                    value="{{ $user->firstname }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname" class="col-sm-3 text-end control-label col-form-label">Nom</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="lastname" value="{{ $user->lastname }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 text-end control-label col-form-label">Téléphone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 text-end control-label col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="email" value="{{ $user->firstname }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="origine" class="col-sm-3 text-end control-label col-form-label">Role
                                application</label>
                            <div class="col-sm-9">
                                <div class="col-sm-9">
                                    <select class="form-control" name="role">
                                        @foreach ($roles as $role)
                                            @if ($user->role_id == $role->id)
                                                <option selected value="{{ $role->id }}">
                                                    @if ($role->name == 'all')
                                                        Administrateur
                                                    @else
                                                        Vendeur
                                                    @endif
                                                </option>
                                            @else
                                                <option value="{{ $role->id }}">
                                                    @if ($role->name == 'all')
                                                        Administrateur
                                                    @else
                                                        Vendeur
                                                    @endif
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 text-end control-label col-form-label">Poste</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="title">
                                    @foreach ($titles as $title)
                                        @if ($user->title_id == $title->id)
                                            <option selected value="{{ $title->id }}">{{ $title->name }}</option>
                                        @else
                                            <option value="{{ $title->id }}">{{ $title->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <input type="checkbox" name="modify_pwd" id="checked" class="form-check">
                        <label for="modify_pwd">voulez-vous modifier le mot de passe?</label>
                        <div id="pwd_row" class="row hide">
                            <h4 class="text-center">Modifier mot de passe</h4>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 text-end control-label col-form-label">Nouveau mot de
                                    passe</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control required" id="password" name="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirm"
                                    class="col-sm-3 text-end control-label col-form-label">Confirmez mot de passe</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control required" id="password_confirmation"
                                        name="password_confirmation">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-4">
                                <input type="submit" value="Modifier"
                                    class="form-control btn btn-success mb-4 text-white btn-lg">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script>
        var check = document.getElementById('checked');
        var row_check = document.getElementById('pwd_row');
        check.addEventListener('change', function() {
            if (row_check.classList.contains('hide')) {
                row_check.classList.remove('hide').add('show');
            } else {
                row_check.classList.add('hide').remove('show');
            }

        });
    </script>
@endsection
