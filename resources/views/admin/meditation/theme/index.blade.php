@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Медитация</span>
            <h3 class="page-title">Темы медитации</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Темы медитации</h6>
                </div>
                <div class="card-header border-bottom">
                    <a href="{{route('meditation.index')}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">
                        <i class="material-icons md-12">arrow_back</i> Назад
                    </a>
                    <a href="{{route('meditation.theme.create', ['meditationId' => $meditationId])}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">Добавить
                        <i class="material-icons md-12">add_circle</i>
                    </a>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">Название</th>
                            <th scope="col" class="border-0">Материалы</th>
                            <th scope="col" class="border-0">Создан</th>
                            <th scope="col" class="border-0">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($themes as $theme)
                            <tr>
                                <td>{{$theme->id}}</td>
                                <td>{{$theme->title}}</td>
                                <td>
                                    @foreach($theme->audios as $audio)
                                <audio src="{{asset('audios'.$audio->audio_path)}}" controls>
                                    Не поддерживается
                                </audio>
                                        <br>
                                        @endforeach
                                </td>
                                <td>{{$theme->created_at}}</td>
                                <td>
                                    <a class="btn btn-outline-primary mb-2 "
                                       href="{{route('meditation.theme.edit', ['id' => $theme->id])}}">
                                        <i class="material-icons md-12">edit</i>
                                    </a>
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
