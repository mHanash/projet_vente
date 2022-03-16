@extends('layout.main')

@section('content')
    <div style="height: 100vh; overflow:scroll">
        <div class="page-breadcrumb">
            <div class="row align-items-center justify-content-center">
                <div class="col-5">
                    <h4 class="page-title" style="text-align: center">Modifier les informations du client <br />
                        {{ $customer->firstname }} {{ $customer->lastname }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="content-fluid mb-3">
            <div class="card w-75 m-auto">
                <form class="form-horizontal" method="POST" action="{{ route('customer.update') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="firstname" class="col-sm-3 text-end control-label col-form-label">Prénom</label>
                            <input type="hidden" class="form-control" name="id" value="{{ $customer->id }}"/>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="firstname" value="{{ $customer->firstname }}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname" class="col-sm-3 text-end control-label col-form-label">Nom</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="lastname" value="{{ $customer->lastname }}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 text-end control-label col-form-label">Téléphone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone" value="{{ $customer->phone }}"/>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success text-white btn-lg">
                                    Modifier
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
