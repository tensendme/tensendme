@extends('admin.layouts.admin')

@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Про нас</span>
            <h3 class="page-title">Про нас</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <a href="{{route('setting.index')}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">
                        <i class="material-icons md-12">arrow_back</i> Назад
                    </a>
                    <h6 class="m-0">Редактирование про нас</h6>
                </div>
                <div class="card-body p-2 pb-4 text-center">
                    <img class="default_image_size col-md-4" src="{{asset($setting->img_path)}}">
                    <form method="post"
                          action="{{route('setting.update')}}"
                          enctype="multipart/form-data">
                        @include('admin.settings.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
