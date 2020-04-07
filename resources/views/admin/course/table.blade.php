<div class="card-body p-0 pb-3 text-center">
    <table class="table mb-0">
        <thead class="bg-light">
        @if(!$courses->items())
            <tr>Курсов не найдено!</tr>
        @else
            <tr>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="id">#</a></th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="title">Название</a></th>
                <th scope="col" class="border-0">Категория</th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="is_visible">Виден</a></th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="scale">Рейтинг</a></th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="view_count">Просмотрено</a></th>
                <th scope="col" class="border-0">Уроков</th>
                <th scope="col" class="border-0">Автор</th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="created_at">Создан</a></th>
                <th scope="col" class="border-0">Действия</th>
            </tr>
        @endif
        </thead>
        <tbody>
        @foreach($courses as $course)
            <tr>
                <td>{{$course->id}}</td>
                <td>{{$course->title}}</td>
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
                    <a class="btn btn-outline-primary mb-2 "
                       href="{{route('course.edit', ['id' => $course->id])}}">
                        <i class="material-icons md-12">edit</i>
                    </a>
                    @if(in_array(Auth::user()->role_id ,[1,2,3]))
                        <form class="d-inline" method="post"
                              action="{{route('course.visible', ['id' => $course->id])}}">
                            {{csrf_field()}}
                            @if($course->is_visible)
                                <button class="mb-2 btn  btn-outline-success mr-1" type="submit">
                                    <i class="material-icons md-12">remove_red_eye</i>
                                </button>
                            @else
                                <button class="mb-2 btn  btn-outline-danger mr-1" type="submit">
                                    <i class="material-icons md-12">remove_red_eye</i>
                                </button>
                            @endif
                        </form>
                    @endif
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
                    <a class="btn btn-outline-primary mb-2 "
                       href="{{route('course.material.index', ['course_id' => $course->id])}}">
                        <i class="material-icons md-12">bookmark</i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>
<div class="card-footer">
    @if($courses->items())
        <p style="text-align: center">Показано с {{ $courses->firstItem() }} до {{ $courses->lastItem() }}
            из {{$courses->total()}} записей</p>
        {{ $courses->links() }}
    @endif

</div>
