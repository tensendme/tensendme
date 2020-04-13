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

        select::-ms-expand {
            display: none;
        }

        .select2-selection__arrow b {
            display: none !important;
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

        .form-row {
            display: flex;
            justify-content: center;
            align-items: center;
            align-content: center;
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
            height: 180px;
            width: auto;
            margin: 50px auto 20px auto;
        }

        .tensend-icon.rounded-circle {
            border-radius: 50%;
        }

        .content {
            text-align: center;
        }

        h5.content {
            color: #344356;
            font-family: 'Montserrat';
            font-weight: 600;
            font-size: 20px;
        }

        h3.content {
            color: #344356;
            font-family: 'Montserrat';
            font-weight: 100;
            font-size: 13.5px;
        }

        .w-97 {
            background-color: #004DC9;
            height: 60px;
            width: 100%;
            color: white;
            margin: 15px auto 15px;
            font-size: 20px;
            letter-spacing: 1.6px;
            text-align: center;
            font-weight: 600;
            border: 0;
            -webkit-appearance: none;
            -webkit-box-shadow: 0px 1px 20px 15px rgba(0, 77, 201, 0.21);
            box-shadow: 0px 1px 18px 12px rgba(0, 77, 201, 0.17);
            border-radius: 15px;
        }

        .w-97:disabled {
            opacity: 0.4;
        }

        .w-97 i {
            margin-left: 20px;
            margin-right: -25px;
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

        .wizard {
            margin: 0px auto;
            background: #fff;
        }

        .wizard .nav-tabs {
            position: relative;
            margin: 30px auto;
            margin-bottom: 0;
            border-bottom-color: #344356;
        }

        .wizard > div.wizard-inner {
            position: relative;
        }

        .connecting-line {
            height: 3px;
            background: #344356;
            position: absolute;
            width: 78%;
            margin: 0 auto;
            left: 0;
            right: 0;
            top: 28%;
            z-index: 1;
        }

        .wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
            color: white;
            cursor: default;
            border: 0;
            border-bottom-color: transparent;
        }

        span.round-tab {
            width: 40px;
            height: 40px;
            line-height: 35px;
            display: inline-block;
            border-radius: 100px;
            background: #E3EBF8;
            border: 2px solid #344356;
            z-index: 2;
            position: absolute;
            left: 0;
            text-align: center;
            font-size: 25px;
        }

        span.round-tab i {
            color: #0066DF;
        }

        .wizard li.active span.round-tab {
            background: #0066DF;
            border: 2px solid #344356;

        }

        .wizard li.active span.round-tab i {
            color: #0066DF;
        }

        .wizard .nav-tabs > li {
            width: 24%;
        }

        .wizard li:after {
            content: " ";
            position: absolute;
            left: 10%;
            opacity: 0;
            margin: 0 auto;
            bottom: 0px;
            border: 5px solid transparent;
            border-bottom-color: #0066DF;
            transition: 0.1s ease-in-out;
        }

        .wizard li.processing span.round-tab {
            color: white;
            border: 2px solid #344356;
            background: #0066DF;
        }

        .wizard li.active:after {
            content: " ";
            position: absolute;
            left: 47%;
            opacity: 1;
            margin: 0 auto;
            bottom: 0px;
            border: 10px solid transparent;
            border-bottom-color: #0066DF;
        }

        .wizard .nav-tabs > li a {
            width: 80px;
            height: 65px;
            margin: 0 30px 0 40%;
            border-radius: 100%;
            padding: 0;
        }

        .wizard .nav-tabs > li a:hover {
            background: transparent;
            border: 0;
        }

        .wizard h3 {
            margin-top: 0;
        }

        .custom_image_size {
            width: auto;
            height: 20px
        }

        form {
            /*max-width: 400px;*/
            /*padding: 20px 40px;*/
            /*background: #fff;*/
            /*height: 300px;*/
            /*margin: auto;*/
            /*display: block;*/
            /*position: relative;*/
            /*z-index: 500;*/
            /*border:1px solid #eee;*/
        }

        .form-group {

            position: relative;
            font-size: 18px;
            color: #344356;
            /*margin-top: 30px;*/
            text-align: left;
        }

        .form-label {
            position: relative;
            z-index: 1;
            left: 0;
            top: 5px;
            font-family: 'Montserrat';
            font-weight: 500;
            color: #344356;
            transition: 0.3s;
            translateY: -15px;

        }

        .form-control {
            width: 100%;
            position: relative;
            margin: 0 0 0 0;
            z-index: 3;
            height: 40px;
            background: none;
            border: none;
            padding: 5px 5px;
            border-bottom: 2px solid #344356;
            color: #344356;
            font-size: 18px;
            transition: 0.3s;
            border-radius: 0px;
            box-shadow: 0 1px #344356;
        }

        input {
            background-color: white !important;
            font-family: 'Montserrat';
            font-weight: 500;
            color: #344356;
            border: none;
            margin: 0 0 0 0;
            position: relative;
        }

        .select2-container--default .select2-selection--single {
            background-color: white !important;
            font-family: 'Montserrat';
            font-weight: 500;
            color: #344356;
            border: none;
            border-bottom: 2px solid #344356;
            position: relative;
            border-radius: 0px;
            box-shadow: 0 1px #344356;
            height: auto;
        }

        .country_text {
            font-weight: 700;
            margin: 5px 5px 5px 0;
            font-size: 12.5pt;
            text-align: center;
        }

        .sub-title {
            font-weight: 400;
            font-size: 20px;
        }

        .sub-price {
            font-weight: 600;
            font-size: 30px;
        }

        .list-group-item.active,
        .list-group-item.active:hover {
            background-color: #FFAD00 !important;
            border-color: grey !important;
        }

        @media ( max-width: 700px ) {

            .wizard {
                width: 95%;
                margin: 0 0 0 0;
                height: auto !important;
            }

            span.round-tab {
                font-size: 25px;
                width: 40px;
                height: 40px;
                line-height: 35px;
            }

            .wizard .nav-tabs > li a {
                width: 40px;
                height: 65px;
            }

            .wizard li.active:after {
                content: " ";
                position: absolute;
                left: 53.5%;
            }

            .country_text {
                font-weight: 700;
                margin: 2px 2px 2px 2px;
                font-size: 12.5pt;
                text-align: center;
            }

            .custom_image_size {
                width: auto;
                height: 20px
            }

            .form-control {
                margin: 0 0 2% 0;
                box-shadow: 0 1px #344356;
                /*-webkit-box-shadow: 1px 1px 0.25em 0.25em #a8a8a8;*/

            }

            .form-group {

                font-size: 22px;
                color: #344356;
                /*margin-top: 30px;*/
                text-align: left;
            }

            .form-label {
                font-family: 'Montserrat';
                transition: 0.3s;
                translateY: -15px;

            }

            .form-control {
                font-size: 22px;

            }
        }
    </style>
</head>
<div class="container">
    <div class="row">
        <section>
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active processing">
                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="1">
                                <span class="round-tab">1</span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="2">
                                <span class="round-tab">2</span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="3">
                                <span class="round-tab">3</span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#step4" data-toggle="tab" aria-controls="complete" role="tab" title="Төлем">
                                <span class="round-tab">4</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>
<body class="flex-center position-ref full-height">
<div class="tab-content">
    <div class="content first-step tab-pane active" role="tabpanel" id="step1">
        <img class="tensend-icon" src="{{asset('illustration.png')}}" alt="">
        <h5 class="content">
            Tensend төлем <br>
            парақшасына қош келдіңіз!
        </h5>
        <h3 class="content">
            Небәрі 3 қадамнан соң Tensend-тегі барлық
            <br>курстарды қарауыңызға
            <br>болады.<br>
        </h3>
        <button class="w-97 next-step" type="button" id="">КЕТТІК</button>
    </div>
    <div class="content second-step tab-pane" role="tabpanel" id="step2">
        <img class="tensend-icon" src="{{asset('illustration2.png')}}" alt="">
        <form id="paymentFormSample" class="container-col">
            <div class="form-group">
                <label class="form-label">Телефон нөміріңіз</label>
                <div class="form-row">
                    <select id="id_select2_example" class="form-control" name="country">
                        @foreach($countries as $country)
                            <option value="{{$country->id}}" data-img_src="{{asset($country->image_path)}}">
                                {{$country->phone_prefix}}
                            </option>
                        @endforeach
                    </select>
                    <input id="phone" class="phone m-b-md form-control" type="text" inputmode="numeric" name="phone">
                    {{--                           pattern="^\([0-9]{3}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}$">--}}
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Құпия сөзіңіз</label>
                <input id="password" class="password form-control" type="password" name="password">
            </div>
            <button class="w-97 next-step" type="submit">
                ЖАЛҒАСТЫРУ<i class="glyphicon glyphicon-arrow-right"></i>
            </button>
        </form>
    </div>
    <div class="content second-step tab-pane" role="tabpanel" id="step3">

        <form id="form1">

            <div class="form-group">
                <p class="text-center">
                    <img class="rounded-circle tensend-icon" src="{{asset('images/user-default.png')}}" alt="">
                </p>

                <p class="text-center">
                    <label class="form-label">
                        Қош келдіңіз
                    </label>
                </p>
                <p class="text-center">
                    Төлемге көшпес бұрын, тарифіңізді <br>
                    тексеріп алыңыз
                </p>
                <p class="text-center">
                    <label class="form-label">
                        Тандалған тариф
                    </label>
                </p>
                <ul class="list-group" id="subscriptionList">
                    @foreach($subscriptions as $subscription)
                        <li class="list-group-item" onclick="toggleChoosen(this)">
                            <p class="sub-title text-center">
                                {{$subscription->name}}
                            </p>
                            <p class="sub-price  text-center">
                                {{$subscription->price}} KZT
                            </p>
                        </li>
                    @endforeach

                </ul>
            </div>
            <button class="w-97 next-step" type="submit" disabled>
                ТӨЛЕМГЕ КӨШУ<i class="glyphicon glyphicon-arrow-right"></i>
            </button>
        </form>
    </div>

    <div class="content first-step tab-pane" role="tabpanel" id="step4">
        @if(true)
            <img class="tensend-icon" src="{{asset('illustration4.png')}}" alt="">
            <h5 class="content">
                Төлем сәтті аяқталды!
            </h5>
            <h3 class="content">
                Tensend-пен бірге таптырмас білім алуда <br>сізге сәттілік тілейміз!
            </h3>
        @else
            <img class="tensend-icon" src="{{asset('illustration5.png')}}" alt="">
            <h5 class="content">
                Енгізілген ақпарат жарамсыз!
            </h5>
            <h3 class="content">
                Ақпаратты қайтадан тексеріп, енгізіңіз!
            </h3>
        @endif
    </div>

</div>
<script src="{{asset('admin/scripts/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('admin/scripts/select2.min.js')}}"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script>
</script>
<script type="text/javascript">
    var subscriptionList = document.getElementById("subscriptionList");

    function toggleChoosen(li) {
        var all = subscriptionList.querySelectorAll('.list-group-item');
        all.forEach(el => {
            if (el.classList.contains('active')) {
                el.classList.remove('active');
            }
        });
        li.classList.add('active');
        if (document.getElementById('step3').querySelector('button').disabled) {
            document.getElementById('step3').querySelector('button').disabled = false;
        }

    }

    function custom_template(obj) {
        var data = $(obj.element).data();
        var text = $(obj.element).text();
        if (data && data['img_src']) {
            img_src = data['img_src'];
            template = $("<div class=\"row\"><img class=\"custom_image_size\" src=\"" + img_src + "\"/><p class=\"country_text\">" + text + "</p></div>");
            return template;
        }
    }

    var options = {
        'templateSelection': custom_template,
        'templateResult': custom_template,
    };
    $('#id_select2_example').select2(options);

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

    // document.getElementById("phone").onkeypress = validate_int;
    // document.getElementById("phone").onkeyup = phone_number_mask;

    $(document).ready(function () {
        //Initialize tooltips
        $('.nav-tabs > li a[title]').tooltip();

        //Wizard
        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

            var $target = $(e.target);

            if ($target.parent().hasClass('disabled')) {
                return false;
            }
        });

        $(".next-step").click(function (e) {
            var $active = $('.wizard .nav-tabs li.active');
            $active.next().removeClass('disabled');
            $active.next().addClass('processing');
            nextTab($active);

        });
        $(".prev-step").click(function (e) {

            var $active = $('.wizard .nav-tabs li.active');
            prevTab($active);

        });
    });

    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
    }

    function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }


    $(document).ready(function () {
        var form = $('#paymentFormSample');

        form.on('submit', (e) => {
            e.preventDefault();
            sendPhone1();
            return false;
        });


    });


    function sendPhone1() {
        prefix = $("#list option[value=" + document.getElementById("id_select2_example").value + "]").text();
        if (prefix.startsWith("+")) {
            prefix = prefix.substring(1);
        }
        var raw = JSON.stringify({
            "password": document.getElementById("password").value,
            "country": document.getElementById("id_select2_example").value,
            "phone": prefix + document.getElementById("phone").value
        });


        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");
        // myHeaders.append("Authorization", `Bearer ${token}`);


        var requestOptions = {
            method: 'POST',
            headers: myHeaders,
            body: raw,
            redirect: 'follow'
        };
        fetch("https://tensend.me/api/v1/send/phone", requestOptions)
        // fetch("http://127.0.0.1:8000/api/v1/send/phone", requestOptions)
            .then(response => response.json())
            .then(result => {
                console.log(result);
                if (result.success === false) {

                    // document.getElementById("user-avatar").
                    $("#form1").append('<img class="tensend-icon" src="{{asset("illustration3.png")}}" alt="">\n' +
                        '\n' +
                        '\n' +
                        '            <div class="form-group">\n' +
                        '                <label class="form-label">Телефон нөміріңіз</label>\n' +
                        '\n' +
                        '                <div class="form-row">\n' +
                        '                    <select id="id_select2_example1" class="form-control" name="country">\n' +
                        '                        @foreach($countries as $country)\n' +
                        '                            <option value="{{$country->id}}" data-img_src="{{asset($country->image_path)}}">\n' +
                        '                                {{$country->phone_prefix}}\n' +
                        '                            </option>\n' +
                        '                        @endforeach\n' +
                        '                    </select>\n' +
                        '                                        <input id="phone2" class="phone m-b-md form-control" type="text" inputmode="numeric" name="phone"\n' +
                        '                                               pattern="^\\([0-9]{3}\\)\\s[0-9]{3}-[0-9]{2}-[0-9]{2}$">\n' +
                        '                </div>\n' +
                        '            </div>\n' +
                        '            <button class="w-97 next-step" type="button" id="">APPSTORE-ГЕ КӨШУ</button>\n' +
                        '\n' +
                        '        <h5 class="content">\n' +
                        '            Бұл нөмір жүйеде тіркелмеген!\n' +
                        '        </h5>\n' +
                        '        <h3 class="content">\n' +
                        '            Appstore-ден Tensend қосымшасын жүктеп, <br>жүйеге тіркеліңіз\n' +
                        '        </h3>\n');

                    document.getElementById("username").value = result.username;

                }
                else {

                    $("#form1").append('<div class="form-group">\n' +
                        '<img class="tensend-icon" src="' + result.avatar + '" alt="">\n' +
                        '                            <label class="form-label" id="username">' + result.username + '</label>\n' +
                        '\n' +
                        '\n' +
                        '\n' +
                        '                    @foreach($subscriptions as $subscription)\n' +
                        '                    <form id = "subscriptionForm">\n' +
                        '                        <div class="form-row">\n' +
                        '                            <label class="form-label">{{$subscription->name}}</label>\n' +
                        '                            <br>\n' +
                        '                            <label class="form-label">{{$subscription->price}}</label>\n' +
                        '                            <br>\n' +
                        '                            <label class="form-label">{{$subscription->id}}</label>\n' +
                        '                            <br>\n' +
                        '                    <button class="w-97 next-step" type="submit" >толем жасау<i class="glyphicon glyphicon-arrow-right"></i></button>\n' +

                        '                            <br>\n' +
                        '\n' +

                        '                        </div>\n' +
                        '                        <br>\n' +
                        '                    </form>\n' +
                        '                    @endforeach\n' +
                        '\n' +
                        '\n' +
                        '\n' +
                        '\n' +
                        '            </div>\n');
                    const token = result.token;
                    $(document).ready(function () {
                        var form = $('#subscriptionForm');

                        form.on('submit', (e) => {
                            e.preventDefault();
                            submitForm();
                            return false;
                        });


                    });

                    function submitForm() {
                        var myHeaders = new Headers();
                        myHeaders.append("Authorization", `Bearer ${token}`);
                        var requestOptions = {
                            method: 'GET',
                            headers: myHeaders,
                            redirect: 'follow'
                        };

                        {{--fetch("http://127.0.0.1:8000/api/v1/pay?subscription_type_id={{$subscription->id}}", requestOptions)--}}
                        fetch("https://tensend.me/api/v1/pay?subscription_type_id={{$subscription->id}}", requestOptions)
                            .then(result => result.text()).then(result => {
                            console.log({{$subscription->id}});
                            document.open();
                            document.write(result);
                            document.close();
                        })
                            .catch(error => console.log('error', error));

                    }
                }
            });


    }


    // $(document).ready(function () {
    //     var form = $('#subscriptionForm');
    //
    //     form.on('submit', (e) => {
    //         e.preventDefault();
    //         sendSubscription();
    //         return false;
    //     });
    //
    //
    // });


    // const urlParams = new URLSearchParams(window.location.search);
    // const token = urlParams.get('token');

</script>
</body>
</html>
