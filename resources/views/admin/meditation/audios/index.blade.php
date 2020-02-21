@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Медитация</span>
            <h3 class="page-title">Аудио материалы</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Аудио материалы медитации</h6>
                </div>
                <div class="card-header border-bottom">
                    <a href="{{route('meditation.index')}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">
                        <i class="material-icons md-12">arrow_back</i> Назад
                    </a>
                    <a href="{{route('meditation.audio.create', ['meditationId' => $meditationId])}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">Добавить
                        <i class="material-icons md-12">add_circle</i>
                    </a>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">Язык</th>
                            <th scope="col" class="border-0">Автор</th>
                            <th scope="col" class="border-0">Продолжительность</th>
                            <th scope="col" class="border-0">Доступ</th>
                            <th scope="col" class="border-0">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($audios as $audio)
                            <tr>
                                <td>{{$audio->id}}</td>
                                <td>{{$audio->language->name}}</td>
                                <td>{{$audio->author->name}}</td>
                                <td>{{$audio->duration}} мин</td>
                                <td>@if($audio->free)
                                        <span class="text-success">
                                            Бесплатно
                                        </span>
                                    @else<span class="text-danger">
                                            С подпиской
                                        </span>
                                @endif
                                </td>
                                <td>
                                    <a class="btn btn-outline-primary mb-2 "
                                       href="{{route('meditation.audio.edit', ['id' => $audio->id])}}">
                                        <i class="material-icons md-12">edit</i>
                                    </a>
{{--                                    <a class="btn btn-outline-primary mb-2 "--}}
{{--                                       href="{{route('meditation.audio.index', ['meditationId' => $meditation->id])}}">--}}
{{--                                        Добавить тему<i class="material-icons md-12">add</i>--}}
{{--                                    </a>--}}
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
