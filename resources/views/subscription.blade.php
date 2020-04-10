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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title>Реферальная ссылка</title>
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
            margin: 40px 0 0 0;
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
            height: 300px;
            width: auto;
            margin: 50px auto 20px auto;
        }

        .content {
            text-align: center;
        }

        .w-97 {
            background-color: rgba(0, 77, 192, 0.9);
            height: 60px;
            width:100%;
            color: white;
            margin: 15px auto 50px;
            font-size: 20px;
            border: 0;
            -webkit-appearance: none;
            -webkit-box-shadow: 0px 1px 20px 15px rgba(0, 77, 201, 0.21);
            box-shadow: 0px 1px 18px 12px rgba(0, 77, 201, 0.17);
            border-radius: 15px;
        }

        .w-97:disabled {
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
        .wizard {
            margin: 20px auto;
            background: #fff;
        }

        .wizard .nav-tabs {
            position: relative;
            margin: 40px auto;
            margin-bottom: 0;
            border-bottom-color: #e0e0e0;
        }

        .wizard > div.wizard-inner {
            position: relative;
        }

        .connecting-line {
            height: 3px;
            background: #e0e0e0;
            position: absolute;
            width: 80%;
            margin: 0 auto;
            left: 0;
            right: 9;
            top: 25%;
            z-index: 1;
        }

        .wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
            color: #0048cd;
            cursor: default;
            border: 0;
            border-bottom-color: transparent;
        }

        span.round-tab {
            width: 20px;
            height: 20px;
            line-height: 15px;
            display: inline-block;
            border-radius: 50px;
            background: #fff;
            border: 2px solid #e0e0e0;
            z-index: 2;
            position: absolute;
            left: 0;
            text-align: center;
            font-size: 12px;
        }
        span.round-tab i{
            color:#0048cd;
        }
        .wizard li.active span.round-tab {
            background: #fff;
            border: 2px solid #0048cd;

        }
        .wizard li.active span.round-tab i{
            color: #0048cd;
        }

        span.round-tab:hover {
            color: #0048cd;
            border: 2px solid #0048cd;
        }

        .wizard .nav-tabs > li {
            width: 25%;
        }

        .wizard li:after {
            content: " ";
            position: absolute;
            left: 10%;
            opacity: 0;
            margin: 0 auto;
            bottom: 0px;
            border: 5px solid transparent;
            border-bottom-color: #0048cd;
            transition: 0.1s ease-in-out;
        }

        .wizard li.active:after {
            content: " ";
            position: absolute;
            left: 5%;
            opacity: 1;
            margin: 0 auto;
            bottom: 0px;
            border: 10px solid transparent;
            border-bottom-color: #0048cd;
        }

        .wizard .nav-tabs > li a {
            width: 80px;
            height: 50px;
            margin: 9px auto;
            border-radius: 100%;
            padding: 0;
        }

        .wizard .nav-tabs > li a:hover {
            background: transparent;
        }

        .wizard h3 {
            margin-top: 0;
        }

        @media( max-width : 585px ) {

            .wizard {
                width: 100%;
                height: auto !important;
            }

            span.round-tab {
                font-size: 5px;
                width: 50px;
                height: 50px;
                line-height: 50px;
            }

            .wizard .nav-tabs > li a {
                width: 90px;
                height: 50px;
                line-height: 50px;
            }

            .wizard li.active:after {
                content: " ";
                position: absolute;
                left: 35%;
            }
        }
    </style>
</head>
<div class="content">
    <div class="row">
        <section>
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">

                        <li role="presentation" class="active">
                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">1</span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">2</span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">3</span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">4</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>
<body class="flex-center position-ref full-height wave">
<div class="content first-step" id="step1">
    <img class="tensend-icon" src="{{asset('mobile.jpg')}}" alt="">
    <h2 class="content">
        Tensend төлем <br>
        парақшасына қош келдіңіз!</h2>
        <h4>
        Небәрі 3 қадамнан соң Tensend-тегі барлық
        <br>курстарды қарауыңызға
        <br>болады.<br>
    </h4>
    <input class="w-97 submit-btn" type="submit" value="Кеттік" id="">
</div>
<div class="content second-step">
    <img class="tensend-icon" src="{{asset('mobile.jpg')}}" alt="">
    <h3>Телефон нөмеріңіз</h3>
    <div class="row">
        <select id="id_select2_example" style="width: 150px;" name="country">
            @foreach($countries as $country)
                <option value="{{$country->id}}" data-img_src="{{asset($country->image_path)}}">
                    {{$country->phone_prefix}}
                </option>
            @endforeach
        </select>
        <input id="phone" class="phone m-b-md" type="text" inputmode="numeric" name="phone"
               pattern="^\([0-9]{3}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}$">
    </div>
    <div class="row">
        <input id="password" class="password" type="text" name="phone"
               pattern="^\([0-9]{3}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}$">
    </div>
    <input class="w-97 submit-btn" type="submit" value="Kettik" id="">
</div>
<script src="{{asset('admin/scripts/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('admin/scripts/select2.min.js')}}"></script>
<script>
</script>
<script type="text/javascript">
    function custom_template(obj) {
        var data = $(obj.element).data();
        var text = $(obj.element).text();
        if (data && data['img_src']) {
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
        if (theLastPos === 15) {
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
