<div class="card-body p-0 pb-3 text-center">
    <table class="table mb-0">
        <thead class="bg-light">
        @if(!$transactions->items())
            <tr>Транзакции не найдено!</tr>
        @else
            <tr>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="id">#</a></th>
                <th scope="col" class="border-0">Пользователь</th>
                <th scope="col" class="border-0">Номер телефона</th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="order_id">Номер транзакции</a></th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="sum">Цена</a></th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="status">Статус</a></th>
                <th scope="col" class="border-0">Сообщение</th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="created_at">Дата</a></th>
            </tr>
        @endif
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
    @if($transactions->items())
        <p style="text-align: center">Показано с {{ $transactions->firstItem() }} до {{ $transactions->lastItem() }}
            из {{$transactions->total()}} записей</p>
        {{ $transactions->links() }}
    @endif
</div>

