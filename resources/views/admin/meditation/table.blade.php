<div class="card-body p-0 pb-3 text-center">
    <table class="table mb-0">
        <thead class="bg-light">
        @if(!$meditations->items())
            <tr>Курсов не найдено!</tr>
        @else
            <tr>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="id">#</a></th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="title">Название</a></th>
                <th scope="col" class="border-0">Категория</th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="is_visible">Виден</a></th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="scale">Рейтинг</a></th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="created_at">Создан</a></th>
                <th scope="col" class="border-0">Действия</th>
            </tr>
        @endif
        </thead>
        <tbody>
        @foreach($meditations as $meditation)
            <tr>
                <td>{{$meditation->id}}</td>
                <td>{{$meditation->title}}</td>
                <td>{{$meditation->category->name}}</td>
                <td>
                    @if($meditation->is_visible)
                        <span class="text-success">
                                            Виден
                                        </span>
                    @else
                        <span class="text-danger">
                                            Не виден
                                        </span>
                    @endif
                </td>
                <td>{{$meditation->scale}}</td>
                <td>{{$meditation->created_at}}</td>
                <td>
                    <form class="d-inline" method="post"
                          action="{{route('meditation.visible', ['id' => $meditation->id])}}">
                        {{csrf_field()}}
                        @if($meditation->is_visible)
                            <button class="mb-2 btn  btn-outline-success mr-1" type="submit">
                                <i class="material-icons md-12">remove_red_eye</i>
                            </button>
                        @else
                            <button class="mb-2 btn  btn-outline-danger mr-1" type="submit">
                                <i class="material-icons md-12">remove_red_eye</i>
                            </button>
                        @endif
                    </form>

                    <a class="btn btn-outline-primary mb-2 "
                       href="{{route('meditation.edit', ['id' => $meditation->id])}}">
                        <i class="material-icons md-12">edit</i>
                    </a>
                    <a class="btn btn-outline-primary mb-2 "
                       href="{{route('meditation.audio.index', ['meditationId' => $meditation->id])}}">
                        Добавить аудио<i class="material-icons md-12">add</i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="card-footer">
    @if($meditations->items())
        <p style="text-align: center">Показано с {{ $meditations->firstItem() }} до {{ $meditations->lastItem() }}
            из {{$meditations->total()}} записей</p>
        {{ $meditations->links() }}
    @endif
</div>
