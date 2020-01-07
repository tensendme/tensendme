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
                    <h6 class="m-0">Уровни</h6>
                </div>
                <div class="card-header border-bottom">
                    <a href="{{route('level.create')}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">Добавить
                        <i class="material-icons md-12">add_circle</i>
                    </a>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">Название</th>
                            <th scope="col" class="border-0">Старт</th>
                            <th scope="col" class="border-0">Финиш</th>
                            <th scope="col" class="border-0">Процент скидки</th>
                            <th scope="col" class="border-0">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($levels as $level)
                            <tr>
                                <td>{{$level->id}}</td>
                                <td>{{$level->name}}</td>
                                <td>{{$level->start_count}}</td>
                                <td>{{$level->end_count}}</td>
                                <td>{{$level->discount_percentage}}%</td>
                                <td>
                                    <a href="{{route('level.edit', ['id' => $level->id])}}">
                                        <i class="material-icons md-24">edit</i>
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
