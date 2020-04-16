<div class="card-body p-0 pb-3 text-center">
    <table class="table mb-0">
        <thead class="bg-light">
        @if(!$histories->items())
            <tr>Истории не найдено!</tr>
        @else
            <tr>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="id">#</a></th>
                <th scope="col" class="border-0">Пользователь</th>
                <th scope="col" class="border-0">Номер телефона</th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="history_type_id">Тип</a></th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="amount">Сумма</a></th>
                <th scope="col" class="border-0">ID подписки приложениия</th>
                <th scope="col" class="border-0">ID транзакции</th>
                <th scope="col" class="border-0">ID запроса</th>
{{--                <th scope="col" class="border-0">ID подписчика</th>--}}
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="created_at">Записан</a></th>

            </tr>
        @endif
        </thead>
        <tbody>
        @foreach($histories as $history)
            <tr>
                <td>{{$history->id}}</td>
                <td>{{$history->balance->user->name}}</td>
                <td>{{$history->balance->user->phone}}</td>
                <td>{{$history->historyType->name}}</td>
                <td>{{$history->amount}}</td>
                <td>{{$history->subscription_id}}</td>
                <td>{{$history->transaction_id}}</td>
                <td>{{$history->withdrawal_request_id}}</td>
{{--                <td>{{$history->follower_id}}</td>--}}
                <td>{{$history->created_at}}</td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>
<div class="card-footer">
    @if($histories->items())
        <p style="text-align: center">Показано с {{ $histories->firstItem() }} до {{ $histories->lastItem() }}
            из {{$histories->total()}} записей</p>
        {{ $histories->links() }}
    @endif
</div>
