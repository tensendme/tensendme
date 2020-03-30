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
                    <a href="{{route('setting.edit')}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">Редактировать
                        <i class="material-icons md-12">edit</i>
                    </a>
                    <a href="{{route('link.create')}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">Добавить ссылку
                        <i class="material-icons md-12">add</i>
                    </a>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">Телефон</th>
                            <th scope="col" class="border-0">Название</th>
                            <th scope="col" class="border-0">Адрес</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$setting->phone}}</td>
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
                                    <a class="btn btn-outline-primary mb-2 "
                                       href="{{route('link.edit', ['id' => $link->id])}}">
                                        <i class="material-icons md-12">edit</i>
                                    </a>
                                    <form class="d-inline" method="post"
                                          action="{{route('link.visible', ['id' => $link->id])}}">
                                        {{csrf_field()}}
                                        @if($link->is_visible)
                                            <button class="mb-2 btn  btn-outline-success mr-1" type="submit">
                                                <i class="material-icons md-12">remove_red_eye</i>
                                            </button>
                                        @else
                                            <button class="mb-2 btn  btn-outline-danger mr-1" type="submit">
                                                <i class="material-icons md-12">remove_red_eye</i>
                                            </button>
                                        @endif
                                    </form>
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
