<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="yandex-verification" content="a8e58e23cec0472e"/>
    <link rel="stylesheet"
          href="{{asset('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/styles/fonts.css')}}">
    <title>Промо код</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <style>
        html, body {
            background-color: #ffffff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            margin: 0;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .position-ref {
            position: relative;
        }

        .step {
            border-radius: 50%;
            background-color: rgb(250, 248, 255);
            color: black;
            margin: 0;
            height: 100px;
            width: 100px;
            display: flex;
            align-content: center;
            align-items: center;
            justify-content: center;
        }

        .row {
            display: flex;
            justify-content: center;
            align-items: center;
            align-content: center;
        }

        .row > a {
            text-decoration: none;
            margin: 40px;
            background-color: #f4f4f4;
            padding: 20px;
            white-space: nowrap;
            color: black;
        }

        .tensend-icon {
            height: 100px;
            width: auto;
            margin: 50px auto 20px auto;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 40px;
        }

        .discount {
            font-size: 45px;
            font-weight: 600;
            text-align: center;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .cursorShow {
            cursor: pointer;
            right: 40px;
        }

        .tooltiptext {
            position: absolute;
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            opacity: 0.6;
            right: -22px;
            bottom: -40px;
            z-index: 1;
        }

        input:focus {
            outline: none;
        }

        input[type=text] {
            width: 80%;
            padding: 12px 20px;
            margin: 8px 0;
            text-align: center;
            border-radius: 10px;
            border: 0;
            box-sizing: border-box;
            background-color: #0048cd;
            color: white;
        }

        .wave {
            background-image: url({{asset('wave.svg')}});
            background-size: 250px;
            background-repeat: repeat-x;
            background-position: center top;
        }

    </style>
</head>
<body class="flex-center position-ref full-height wave">
<img class="tensend-icon" src="{{asset('tensend_me.png')}}" alt="">
@if($user)
    <div class="step">
        <h1>1</h1>
    </div>
    <div class="content">
        <h3>
            Скачай мобильное приложение <br>
            Tensend по ссылке ниже<br>
            и получи доступ<br>
            к огромному количеству<br>
            качественных курсов<br>
        </h3>
        <br>
        <div class="row">
            <a href="https://www.apple.com/ru/ios/app-store/">AppStore</a>
            <a href="https://play.google.com/store">Google Play</a>
        </div>
    </div>
    <div class="step">
        <h1>2</h1>
    </div>
    <h3 class="content">
        После того как скачаешь<br>
        введи уникальный промо-код,<br>
        указанный ниже и получи скидку<br>
        <p class="discount">-20%</p>
    </h3>
    <div class="content">
        <h3>Твой промо-код</h3>
        <input disabled id="copyText" class="title m-b-md" type="text" value="{{$promoCode}}">
        <div>
            <a style="margin-left: 50px; float: right" class="cursorShow position-ref"
               onclick="copyFunction()">
                <span class="fa fa-clone"></span>
                <span id="myToolTip" class="tooltiptext">Скопировано</span>
            </a>
        </div>
        <br>
        <br>
        <br>
        <br>
    </div>
@else
    <h1 class="content">Просроченный промо-код!</h1>
@endif

<div class="wave">
</div>

<script>
    function copyFunction() {
        var from = document.getElementById('copyText');
        var range = document.createRange();
        window.getSelection().removeAllRanges();
        range.selectNode(from);
        window.getSelection().addRange(range);
        document.execCommand('copy');
        window.getSelection().removeAllRanges();
        var toolTip = document.getElementById('myToolTip');
        toolTip.style.visibility = 'visible';
        setTimeout(() => {
            toolTip.style.visibility = 'hidden';
        }, 1500);
    }
</script>
</body>
</html>
