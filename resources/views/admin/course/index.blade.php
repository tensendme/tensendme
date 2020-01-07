@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Курсы</span>
            <h3 class="page-title">Курсы</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Все курсы</h6>
                </div>
                <div class="card-header border-bottom">
                    <a href="{{route('course.create')}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">Добавить
                        <i class="material-icons md-12">add_circle</i>
                    </a>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">Название</th>
                            <th scope="col" class="border-0">Категория</th>
                            <th scope="col" class="border-0">Виден</th>
                            <th scope="col" class="border-0">Оценка</th>
                            <th scope="col" class="border-0">Просмотрено</th>
                            <th scope="col" class="border-0">Создан</th>
                            <th scope="col" class="border-0">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>{{$course->id}}</td>
                                <td>{{$course->title}}</td>
                                <td>{{$course->category->name}}</td>
                                <td>{{$course->is_visible}}</td>
                                <td>{{$course->scale}}</td>
                                <td>{{$course->view_count}}</td>
                                <td>{{$course->created_at}}</td>
                                <td>
                                    <a href="{{route('course.edit', ['id' => $course->id])}}">
                                        <i class="material-icons md-24">edit</i>
                                    </a>
                                    <form method="post" action="{{route('course.visible', ['id' => $course->id])}}">
                                        {{csrf_field()}}
                                        <button  class="mb-2 btn btn-primary mr-1" type="submit">
                                            <i class="material-icons md-12">remove_red_eye</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="card-footer">
                    {{ $courses->links() }}

                </div>
            </div>
        </div>
    </div>
@endsection
