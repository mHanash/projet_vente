@extends('layout.main')

@section('content')
    <div style="height: 100vh; overflow:scroll">
        <div class="page-breadcrumb">
            <div class="row align-items-center justify-content-center">
                <div class="col-5">
                    <h4 class="page-title" style="text-align: center">Modification de l'option</h4>
                </div>
            </div>
        </div>
        <div class="content-fluid">
            <div class="card mt-5">
                <form method="POST" action="{{ route('setting.update',['id'=>$option->id]) }}" class="form-horizontal" >
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 text-end control-label col-form-label">Désignation</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" value="{{$option->name}}"/>
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
