<!DOCTYPE html>
<head>
    <title>CardStatus</title>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
</head>
<body>
<div class="card-body p-0 pb-3 text-center">
    <table class="table mb-0">
        <thead class="bg-light">
        <tr>

            <th scope="col" class="border-0">Статус</th>


        </tr>
        </thead>
        <tbody>

        <tr>

            <td>{{$transaction->status}}</td>


        </tr>

        </tbody>

    </table>
</div>

</body>




