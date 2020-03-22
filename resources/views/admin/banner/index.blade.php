@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Банеры</span>
            <h3 class="page-title">Банеры</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Все банеры</h6>
                </div>
                <div class="card-header border-bottom">
                    <a href="{{route('banner.create')}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">Добавить
                        <i class="material-icons md-12">add_circle</i>
                    </a>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">Название</th>
                            <th scope="col" class="border-0">Локация</th>
                            <th scope="col" class="border-0">Показ оплаты</th>
                            <th scope="col" class="border-0">Новость</th>
                            <th scope="col" class="border-0">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($banners as $banner)
                            <tr>
                                <td>{{$banner->id}}</td>
                                <td>{{$banner->title}}</td>
                                <td>{{$banner->location->name}}</td>
                                <td>{{$banner->is_payment_enabled ? 'ВКЛ' : 'ОТКЛ'}}</td>
                                <td>{{$banner->news->title}}</td>
                                <td>
                                    <a class="btn btn-outline-primary mb-2 "
                                       href="{{route('banner.edit', ['id' => $banner->id])}}">
                                        <i class="material-icons md-12">edit</i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="card-footer">
                    {{ $banners->links() }}

                </div>
            </div>
        </div>
    </div>
@endsection
