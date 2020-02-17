<!DOCTYPE html>
<head>
    <title>Status</title>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
</head>
<body>
<div class="card-body p-0 pb-3 text-center">
    <table class="table mb-0">
        <thead class="bg-light">
        <tr>
            <th scope="col" class="border-0">Пользователь</th>
            <th scope="col" class="border-0">Номер транзакции</th>
            <th scope="col" class="border-0">Сумма</th>
            <th scope="col" class="border-0">Статус</th>


        </tr>
        </thead>
        <tbody>

        <tr>
            <td>{{ $user->name }}</td>
            <td>{{$transaction->order_id}}</td>
            <td>{{$transaction->sum}}</td>
            <td>{{$transaction->card_holder_message}}</td>


        </tr>

        </tbody>

    </table>
</div>

</body>




