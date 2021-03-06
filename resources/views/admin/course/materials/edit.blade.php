@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Курс Уроки</span>
            <h3 class="page-title">Уроки</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <a href="{{route('course.material.index', ['course_id' => $material->course->id])}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">
                        <i class="material-icons md-12">arrow_back</i> Назад
                    </a>
                    <h6 class="m-0">Редактирование урока</h6>
                </div>
                <div class="card-body p-2 pb-4 text-center">
                    <img class="default_image_size" src="{{asset($material->img_path)}}" alt="Превью урока">
                    <form method="post" action="{{route('course.material.update', ['id' => $material->id])}}" enctype="multipart/form-data">
                        @include('admin.course.materials.form')
                    </form>
                    @if($material->video_path)
                        <video src="{{asset($material->video_path)}}" controls style="height: 350px; width: 700px"></video>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
