<div class="card-body p-0 pb-3 text-center">
    <table class="table mb-0">
        <thead class="bg-light">
        @if(!$subscriptions->items())
            <tr>Подписок не найдено!</tr>
        @else
            <tr>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="id">#</a></th>
                <th scope="col" class="border-0">Пользователь</th>
                <th scope="col" class="border-0">Номер телефона</th>
                <th scope="col" class="border-0"><i class="material-icons">height</i>
                    <a class="sort" id="subscription_type_id">Тип подписки</a></th>
                <th scope="col" class="border-0"><i class="material-icons">height</i>
                    <a class="sort" id="actual_price">Цена</a></th>
                <th scope="col" class="border-0"><i class="material-icons">height</i>
                    <a class="sort" id="expired_at">Срок истечения</a></th>
                <th scope="col" class="border-0"><i class="material-icons">height</i>
                    <a class="sort" id="created_at">Дата оформления</a></th>
            </tr>
        @endif
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
                <td>{{$subscription->created_at}}</td>

            </tr>
        @endforeach
        </tbody>

    </table>
</div>
<div class="card-footer">
    @if($subscriptions->items())
        <p style="text-align: center">Показано с {{ $subscriptions->firstItem() }} до {{ $subscriptions->lastItem() }}
            из {{$subscriptions->total()}} записей</p>
        {{ $subscriptions->links() }}
    @endif
</div>
