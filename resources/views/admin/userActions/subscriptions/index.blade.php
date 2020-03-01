@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Подписки</span>
            <h3 class="page-title">Подписки</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Подписки</h6>
                </div>
                {{--                <div class="card-header border-bottom">--}}
                {{--                    <a href="{{route('level.create')}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">Добавить--}}
                {{--                        <i class="material-icons md-12">add_circle</i>--}}
                {{--                    </a>--}}
                {{--                </div>--}}
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">Пользователь</th>
                            <th scope="col" class="border-0">Номер телефона</th>
                            <th scope="col" class="border-0">Тип подписки</th>
                            <th scope="col" class="border-0">Цена</th>
                            <th scope="col" class="border-0">Срок истечения</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subscriptions as $subscription)
                            <tr>
                                <td>{{$subscription->id}}</td>
                                <td>{{$subscription->user->name}}</td>
                                <td>{{$subscription->user->phone}}</td>
                                <td>{{$subscription->subscriptionType->name}}</td>
                                <td>{{$subscription->actual_price}}</td>
                                <td>{{$subscription->expired_at}}</td>

                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="card-footer">
                    {{ $subscriptions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
