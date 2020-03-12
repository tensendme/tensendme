<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="yandex-verification" content="a8e58e23cec0472e"/>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet"
          href="{{asset('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/styles/fonts.css')}}">
    <title>Промо код</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/styles/select2.min.css')}}">
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
            background-color: rgba(0, 77, 192, 0.9);
            color: white;
            margin: 0;
            height: 100px;
            width: 100px;
            display: flex;
            align-content: center;
            align-items: center;
            justify-content: center;
            -webkit-appearance: none;
            -webkit-box-shadow: 0px 1px 20px 15px rgba(0, 77, 201, 0.21);
            box-shadow: 0px 1px 18px 12px rgba(0, 77, 201, 0.17);
        }

        .row {
            display: flex;
            justify-content: center;
            align-items: center;
            align-content: center;
        }

        .row > a {
            text-decoration: none;
            margin: 20px;
            display: flex;
            background-color: #0a0c0d;
            padding: 10px;
            border-radius: 15.5px;
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
        .w-97 {
            background-color: rgba(0, 77, 192, 0.9);
            height: 50px;
            color: white;
            margin: 15px auto 50px;
            font-size: 20px;
            border: 0;
            -webkit-appearance: none;
            -webkit-box-shadow: 0px 1px 20px 15px rgba(0, 77, 201, 0.21);
            box-shadow: 0px 1px 18px 12px rgba(0, 77, 201, 0.17);
            border-radius: 15px;
        }
        .w-97:disabled{
            opacity: 0.4;
        }
        .title {
            font-size: 35px;
        }
        .phone {
            font-size: 26.5px;
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
            margin-bottom: 20px;
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

        #copyText {
            width: 95%;
            padding: 12px 15px;
            margin: 8px 0;
            text-align: center;
            border-radius: 10px;
            border: 0;
            box-sizing: border-box;
            background-color: #0048cd;
            color: white;
        }

        #phone {
            width: 95%;
            padding: 12px 15px;
            margin: 0 6px 0 1.5px;
            text-align: left;
            border-radius: 3.5px;
            box-sizing: border-box;
            border: rgba(9, 11, 12, 0.36) solid 1px;
            color: black;
        }



        .wave {
            background-image: url({{asset('wave.svg')}});
            background-size: 250px;
            background-repeat: repeat-x;
            background-position: center top;
        }

        .downloadUrl {
            width:40px;
            height:40px;
            margin-left:0.8px;

        }
        .downloadUrlApple {
            width:42.5px;
            height:40px;
        }
        #downloadUrlSpanIos {
            color: white;
            margin-top: 8px;
            font-size: 20px;
            letter-spacing: 0.6px;
            font-style: normal;

        }
        #downloadUrlSpanAndroid {
            margin-top: 8px;
            color: white;
            font-size: 20px;
            font-style: normal;
            letter-spacing: -1px;
        }
    </style>
</head>
<body class="flex-center position-ref full-height wave">
<img class="tensend-icon" src="{{asset('tensend_me.png')}}" alt="">
@if($user)
    <div class="step">
        <h1>1</h1>
    </div>
    <h3 class="content">
        Чтобы получить бесплатный просмотр начальных уроков,<br>
        введите номер телефона,<br>
        скачайте приложение нажав кнопку отправить и получите скидку<br>
    </h3>
    <div class="content">
        <form method="POST" action="{{route('promo-code.post', ['promoCode' => $promoCode])}}">
            {{csrf_field()}}
        <h3>Ваш номер телефона</h3>
        <div class="row">
        <select id="id_select2_example" style="width: 150px;" name="country">
            @foreach($countries as $country)
                <option value="{{$country->id}}" data-img_src="{{asset($country->image_path)}}">
                    {{$country->phone_prefix}}
                </option>
            @endforeach
        </select>
            <input id="phone" class="phone m-b-md" type="text" inputmode="numeric" name="phone" pattern="^\([0-9]{3}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}$">
        </div>
            <input class="w-97 submit-btn" type="submit" value="Отправить" id="sendPhone" disabled>
        </form>
        <br>
        <br>
        <br>
        <br>
    </div>
    <div class="step">
        <h1>2</h1>
    </div>
    <div class="content">
        <h3>
            Скачайте мобильное приложение <br>
            Tensend по ссылке ниже<br>
            и получите доступ<br>
            к огромному количеству<br>
            качественных курсов<br>
        </h3>
        <br>
        <div class="row">
            <a href="itms-apps://apple.com/today">
                <img src="{{asset('apple.png')}}" class="downloadUrlApple" alt="Доступно в">
                <span id="downloadUrlSpanIos">App Store</span>
            </a>
            <a href="http://market.android.com">
                <img src="{{asset('google.png')}}" class="downloadUrl" alt="Доступно в">
                <span id="downloadUrlSpanAndroid">Google Play</span>
            </a>
        </div>
    </div>
{{--    <div class="step">--}}
{{--        <h1>3</h1>--}}
{{--    </div>--}}
{{--    <h3 class="content">--}}
{{--        После того как скачаешь<br>--}}
{{--        введи уникальный промо-код,<br>--}}
{{--        указанный ниже и получи скидку<br>--}}
{{--        <p class="discount">-20%</p>--}}
{{--    </h3>--}}
{{--    <div class="content">--}}
{{--        <h3>Твой промо-код</h3>--}}
{{--        <input disabled id="copyText" class="title m-b-md" type="text" value="{{$promoCode}}">--}}
{{--        <div>--}}
{{--            <a style="margin-left: 50px; float: right" class="cursorShow position-ref"--}}
{{--               onclick="copyFunction()">--}}
{{--                <span class="fa fa-clone"></span>--}}
{{--                <span id="myToolTip" class="tooltiptext">Скопировано</span>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <br>--}}
{{--        <br>--}}
{{--        <br>--}}
{{--        <br>--}}
{{--    </div>--}}
@else
    <h1 class="content">Просроченный промо-код!</h1>
@endif

<div class="wave">
</div>
<script src="{{asset('admin/scripts/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('admin/scripts/select2.min.js')}}"></script>
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
<script type="text/javascript">
    function custom_template(obj){
        var data = $(obj.element).data();
        var text = $(obj.element).text();
        if(data && data['img_src']){
            img_src = data['img_src'];
            template = $("<div class=\"row\"><img class=\"custom_image_size\" src=\"" + img_src + "\" style=\"width:auto;height:25px;\"/><p style=\"font-weight: 700;font-size:11.5pt;text-align:center;\">" + text + "</p></div>");
            return template;
        }
    }
    var options = {
        'templateSelection': custom_template,
        'templateResult': custom_template,
    };
    $('#id_select2_example').select2(options);
    $('.select2-container--default .select2-selection--single').css({'height': '59px'});
    $('.select2-container--default').css({'margin': '0 0 0 6px'});
    // $('.select2-container--open .select2-dropdown--below').css({'left': '6px'});

    function validate_int(myEvento) {
        if ((myEvento.charCode >= 48 && myEvento.charCode <= 57) || myEvento.keyCode == 9 || myEvento.keyCode == 10 || myEvento.keyCode == 13 || myEvento.keyCode == 8 || myEvento.keyCode == 116 || myEvento.keyCode == 46 || (myEvento.keyCode <= 40 && myEvento.keyCode >= 37)) {
            dato = true;
        } else {
            dato = false;
        }
        return dato;
    }

    function phone_number_mask() {
        var myMask = "(___) ___-__-__";
        var myCaja = document.getElementById("phone");
        var myText = "";
        var myNumbers = [];
        var myOutPut = ""
        var theLastPos = 1;
        myText = myCaja.value;
        //get numbers
        for (var i = 0; i < myText.length; i++) {
            if (!isNaN(myText.charAt(i)) && myText.charAt(i) != " ") {
                myNumbers.push(myText.charAt(i));
            }
        }
        //write over mask
        for (var j = 0; j < myMask.length; j++) {
            if (myMask.charAt(j) == "_") { //replace "_" by a number
                if (myNumbers.length == 0)
                    myOutPut = myOutPut + myMask.charAt(j);
                else {
                    myOutPut = myOutPut + myNumbers.shift();
                    theLastPos = j + 1; //set caret position
                }
            } else {
                myOutPut = myOutPut + myMask.charAt(j);
            }
        }
        document.getElementById("phone").value = myOutPut;
        document.getElementById("phone").setSelectionRange(theLastPos, theLastPos);
        if(theLastPos === 15) {
            document.getElementById('sendPhone').disabled = false;
        }
        else {
            document.getElementById('sendPhone').disabled = true;
        }

    }
    document.getElementById("phone").onkeypress = validate_int;
    document.getElementById("phone").onkeyup = phone_number_mask;
</script>
</body>
</html>
