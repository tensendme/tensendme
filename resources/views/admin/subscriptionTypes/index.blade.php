@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Типы подписок</span>
            <h3 class="page-title">Типы подписок</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Типы подписок</h6>
                </div>
                <div class="card-header border-bottom">
                    <a href="{{route('subscription.type.create')}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">Добавить
                        <i class="material-icons md-12">add_circle</i>
                    </a>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">Название</th>
                            <th scope="col" class="border-0">Цена</th>
                            <th scope="col" class="border-0">Срок истечения(дни)</th>
                            <th scope="col" class="border-0">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subscription_types as $subscription_type)
                            <tr>
                                <td>{{$subscription_type->id}}</td>
                                <td>{{$subscription_type->name}}</td>
                                <td>{{$subscription_type->price}}</td>
                                <td>{{$subscription_type->expired_at}}</td>
                                <td>
                                    <a href="{{route('subscription.type.edit', ['id' => $subscription_type->id])}}">
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
