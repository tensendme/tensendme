@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Транзакции</span>
            <h3 class="page-title">Транзакции</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Транзакции</h6>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">Пользователь</th>
                            <th scope="col" class="border-0">Номер телефона</th>
                            <th scope="col" class="border-0">Номер транзакции</th>
                            <th scope="col" class="border-0">Цена</th>
                            <th scope="col" class="border-0">Статус</th>
                            <th scope="col" class="border-0">Сообщение</th>
                            <th scope="col" class="border-0">Дата</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{$transaction->id}}</td>
                                <td>{{$transaction->user->name}} {{$transaction->user->surname}}
                                    {{$transaction->user->fatherName}}</td>
                                <td>+{{$transaction->user->phone}}</td>
                                <td>{{$transaction->order_id}}</td>
                                <td>{{$transaction->sum}}</td>
                                <td>@if($transaction->status == 1)
                                        <span class="text-success">
                                            Подтвержден
                                        </span>
                                    @elseif($transaction->status == 0)
                                        <span class="text-info">
                                            В обработке
                                        </span>
                                    @else
                                        <span class="text-danger">
                                            Отказано
                                        </span>
                                    @endif</td>
                                <td>{{$transaction->card_holder_message}}</td>
                                <td>{{$transaction->updated_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
