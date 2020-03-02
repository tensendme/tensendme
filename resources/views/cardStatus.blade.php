<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,600,600i&display=swap" rel="stylesheet">
    <script src="https://widget.cloudpayments.ru/bundles/checkout"></script>
    <script src="{{asset('front/js/jquery-3.3.1.min.js')}}"
            crossorigin="anonymous"></script>
    <script src="{{asset('js/jquery.inputmask.min.js')}}"></script>
    <title>Payment</title>
    <style type="text/css">
        * {
            font-family: 'Montserrat';
            color: #344356;
        }

        html {
            width: 100%;
            background-color: #F3F5F9;
        }

        body {
            margin: 0 auto;
            width: 80%;
            text-align: center;
        }

        .title {
            text-align: center;
        }

        .container {
            display: flex;
        }

        .container-row {
            display: flex;
            flex-direction: row;
        }

        .container-col {
            display: flex;
            flex-direction: column;
            padding-top: 20px;
            justify-content: center;
            align-items: stretch;
        }

        .img-success {
            width: 80px;
            height: auto;
            margin: 100px auto 0;
        }

        .container > .first-row {
            flex: 1;
        }

        .container > .second-row {
            flex: 1;
            text-align: center;
        }

    </style>
<body>
<img class="img-success" src=@if($transaction->status==3){{asset('payment/check.svg')}}  @else(){{asset('payment/failure.png')}}@endif>

<h3 class="title">@if($transaction->status==3)Карта успешно сохранена @else()Сохранение карты провалено @endif</h3>
</body>

</html>

