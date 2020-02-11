@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Уроки Курсов</span>
            <h3 class="page-title">Уроки</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Все уроки</h6>
                </div>
                <div class="card-header border-bottom">
                    <a href="{{route('course.index')}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">
                        <i class="material-icons md-12">arrow_back</i> Назад
                    </a>
                    <a href="{{route('course.material.create', ['course_id' => $course_id])}}" type="button"
                       class="mb-2 btn btn-medium btn-primary mr-1">Добавить урок
                        <i class="material-icons md-12">add_circle</i>
                    </a>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">Название</th>
                            <th scope="col" class="border-0">Курс</th>
                            <th scope="col" class="border-0">Видео</th>
                            <th scope="col" class="border-0">#Урок</th>
                            <th scope="col" class="border-0">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($materials as $material)
                            <tr>
                                <td>{{$material->id}}</td>
                                <td>{{$material->title}}</td>
                                <td>{{$material->course->title}}</td>
                                <td>
                                @if($material->video_path)
{{--                                        <video src="{{asset($material->video_path)}}" controls--}}
{{--                                               style="height: 130px; width: 150px"></video>--}}
                                    <span class="text-success">Добавлено!</span>
                                @else
                                        <span class="text-danger">Нет видео!</span>
                                @endif
                                </td>
                                <td>#{{$material->ordering}}</td>
                                <td>{{$material->created_at}}</td>
                                <td>
                                    <a class="btn btn-outline-primary mb-2"
                                       href="{{route('course.material.edit', ['id' => $material->id])}}">
                                        <i class="material-icons md-12">edit</i>
                                    </a>
                                    <form class="d-inline" method="post"
                                          action="{{route('course.material.delete', ['id' => $material->id])}}">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button class="mb-2 btn btn-outline-danger mr-1" type="submit">
                                            <i class="material-icons md-12">delete</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="card-footer">
                   Количество: {{ $materials->count() }}

                </div>
            </div>
        </div>
    </div>
@endsection
