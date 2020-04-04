@extends('admin.layouts.admin')

@section('styles')
    <style>
        tbody > tr:hover {
            box-shadow: 0 7px 14px rgba(0, 0, 0, 0.25), 0 5px 5px rgba(0, 0, 0, 0.22);
        }

        .btn-drag {
            cursor: move !important;
        }
    </style>
@endsection

@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Курсы</span>
            <h3 class="page-title">Продвижение курсов</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Все курсы</h6>
                </div>
                <div class="card-header border-bottom">
                    <a href="{{route('course.index')}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">Назад
                        <i class="material-icons md-12">arrow_back</i>
                    </a>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0" id="tblLocations">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0"></th>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">Название</th>
                            <th scope="col" class="border-0">Приоритет</th>
                            <th scope="col" class="border-0">Категория</th>
                            <th scope="col" class="border-0">Виден</th>
                            <th scope="col" class="border-0">Рейтинг</th>
                            <th scope="col" class="border-0">Просмотрено</th>
                            <th scope="col" class="border-0">Уроков</th>
                            <th scope="col" class="border-0">Автор</th>
                            <th scope="col" class="border-0">Создан</th>
                            <th scope="col" class="border-0">Действия</th>
                        </tr>
                        </thead>
                        <tbody class="drag-area">
                        @foreach($courses as $course)
                            <tr class="draggable-element">
                                <td>
                                    <a class="btn-drag btn btn-outline-light mb-2">
                                        <i class="material-icons md-12 ">list</i>
                                    </a>
                                </td>
                                <td class="courseId">{{$course->id}}</td>
                                <td>{{$course->title}}</td>
                                <td class="priority">
                                    {{$course->trending_scale}}
                                </td>
                                <td>{{$course->category->name}}</td>
                                <td>
                                    @if($course->is_visible)
                                        <span class="text-success">
                                            Виден
                                        </span>
                                    @else
                                        <span class="text-danger">
                                            Не виден
                                        </span>
                                    @endif
                                </td>
                                <td>{{$course->scale}}</td>
                                <td>{{$course->view_count}}</td>
                                <td>{{$course->lessons->count()}}</td>
                                <td>
                                    @if($course->author)
                                        {{$course->author->name}}
                                    @else
                                        Автора нет!
                                    @endif
                                </td>
                                <td>{{$course->created_at}}</td>
                                <td>
                                    @if(in_array(Auth::user()->role_id ,[1,2,3]))
                                        <form class="d-inline" method="post"
                                              action="{{route('course.advertise', ['id' => $course->id])}}">
                                            {{csrf_field()}}
                                            @if($course->advertise)
                                                <button class="mb-2 btn  btn-outline-success mr-1" type="submit">
                                                    <i class="material-icons md-12">trending_up</i>
                                                </button>
                                            @else
                                                <button class="mb-2 btn  btn-outline-danger mr-1" type="submit">
                                                    <i class="material-icons md-12">maximize</i>
                                                </button>
                                            @endif
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".drag-area").sortable({
                delay: 100,
                stop: function () {
                    refreshPriority(true);
                }
            });
        });

        function refreshPriority(withAjax = false) {
            var els = document.querySelectorAll('.draggable-element')

            var request = [];
            for (var i = 0; i < els.length; i++) {
                var el = els[i];
                var courseId = parseInt(el.querySelector('.courseId').innerHTML, 10);
                var priority = el.querySelector('.priority').innerHTML = els.length - i;
                request.push({
                    courseId: courseId,
                    priority: priority
                })
            }
            if (withAjax) {
                $.ajax({
                    type: "POST",
                    url: "{{route('course.changePriority')}}",
                    data: JSON.stringify(request),
                    contentType: "json",
                    processData: false,
                    success: function (data) {

                    }
                });
            }
        }

    </script>
@endsection