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
                    <h6 class="m-0">Про нас</h6>
                </div>
                <div class="card-header border-bottom">
{{--                    <a href="{{route('setting')}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">Редактировать--}}
{{--                        <i class="material-icons md-12">add_circle</i>--}}
{{--                    </a>--}}
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">Телефон</th>
                            <th scope="col" class="border-0">Копирайт</th>
                            <th scope="col" class="border-0">Название</th>
                            <th scope="col" class="border-0">Адрес</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$setting->phone}}</td>
                                <td>{{$setting->copyright}}</td>
                                <td>{{$setting->title}}</td>
                                <td>{{$setting->address}}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <hr>
                    <h5>Ссылки</h5>
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">Название</th>
                            <th scope="col" class="border-0">Ссылка</th>
                            <th scope="col" class="border-0">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($links as $link)
                            <tr>
                                <td>{{$link->id}}</td>
                                <td>{{$link->title}}</td>
                                <td>{{$link->url}}</td>
                                <td>
{{--                                    <a class="btn btn-outline-primary mb-2 "--}}
{{--                                       href="{{route('link.edit', ['id' => $n->id])}}">--}}
{{--                                        <i class="material-icons md-12">edit</i>--}}
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
