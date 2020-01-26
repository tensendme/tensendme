@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Истории</span>
            <h3 class="page-title">Истории</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Истории</h6>
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
                            <th scope="col" class="border-0">Тип</th>
                            <th scope="col" class="border-0">Сумма</th>
                            <th scope="col" class="border-0">ID подписки</th>
                            <th scope="col" class="border-0">ID транзакции</th>
                            <th scope="col" class="border-0">ID запроса</th>
                            <th scope="col" class="border-0">ID подписанного пользователя</th>
                            <th scope="col" class="border-0">Произведен</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($histories as $history)
                            <tr>
                                <td>{{$history->id}}</td>
                                <td>{{$history->balance->user->name}}</td>
                                <td>{{$history->historyType->name}}</td>
                                <td>{{$history->amount}}</td>
                                <td>{{$history->subscription_id}}</td>
                                <td>{{$history->transaction_id}}</td>
                                <td>{{$history->withdrawal_request_id}}</td>
                                <td>{{$history->follower_id}}</td>
                                <td>{{$history->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="card-footer">
                    {{ $histories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
