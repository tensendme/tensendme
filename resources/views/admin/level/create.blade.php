@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Уровни</span>
            <h3 class="page-title">Уровни</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <a href="{{route('level.index')}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">
                        <i class="material-icons md-12">arrow_back</i> Назад
                    </a>
                    <h6 class="m-0">Добавление уровня</h6>
                </div>
                <div class="card-body p-2 pb-4 text-center">
                    <form method="post" action="{{route('level.store')}}" enctype="multipart/form-data">
                        @include('admin.level.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
