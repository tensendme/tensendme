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

        .content {
            text-align: center;
        }

        .w-97 {
            background-color: #004DC9;
            height: 60px;
            width:100%;
            color: white;
            margin: 15px auto 50px;
            font-size: 25px;
            letter-spacing: 1.6px;
            font-weight:600;
            border: 0;
            -webkit-appearance: none;
            -webkit-box-shadow: 0px 1px 20px 15px rgba(0, 77, 201, 0.21);
            box-shadow: 0px 1px 18px 12px rgba(0, 77, 201, 0.17);
            border-radius: 15px;
        }

        .w-97:disabled {
            opacity: 0.4;
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
        span.round-tab i{
            color: #0066DF;
        }
        .wizard li.active span.round-tab {
            background: #0066DF;
            border: 2px solid #344356;

        }
        .wizard li.active span.round-tab i{
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

        .wizard li.processing span.round-tab  {
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
            border:0;
        }

        .wizard h3 {
            margin-top: 0;
        }
        .custom_image_size{
            width:auto;
            height:20px
        }
        form{
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
            font-size: 15px;
            color: #344356;
            margin-top: 30px;
            text-align: left;
        }

        .form-label{
            position: relative;
            z-index: 1;
            left: 0;
            top: 5px;
            font-family: 'Montserrat';
            font-weight: 500;
            color:#344356;
            transition: 0.3s;
            translateY: -15px;


        }

        .form-control{
            width: 100%;
            position: relative;
            margin: 0 0 0 0;
            z-index: 3;
            height: 40px;
            background: none;
            border:none;
            padding: 5px 5px;
            border-bottom: 2px solid #344356;
            color: #344356;
            font-size:18px;
            transition: 0.3s;
            border-radius: 0px;
            box-shadow:0 1px #344356;
        }

        input {
            background-color: white !important;
            font-family: 'Montserrat';
            font-weight: 500;
            color:#344356;
            border:none;
            margin: 0 0 0 0;
            position: relative;
        }
        .select2-container--default .select2-selection--single {
            background-color: white !important;
            font-family: 'Montserrat';
            font-weight: 500;
            color:#344356;
            border:none;
            border-bottom: 2px solid #344356;
            position: relative;
            border-radius: 0px;
            box-shadow:0 1px #344356;
            height: auto;
        }
        .country_text {
            font-weight: 700;
            margin:5px 5px 5px 0;
            font-size:12.5pt;
            text-align:center;
        }
        @media( max-width : 585px ) {

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
                margin:2px 2px 2px 2px;
                font-size:12.5pt;
                text-align:center;
            }

            .custom_image_size{
                width:auto;
                height:20px
            }
            .form-control{
                margin: 0 0 2% 0;
                box-shadow:0 1px #344356;
                /*-webkit-box-shadow: 1px 1px 0.25em 0.25em #a8a8a8;*/

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
                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Төлем">
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
        <h3 class="content">
            Tensend төлем <br>
            парақшасына қош келдіңіз!
        </h3>
        <h5>
            Небәрі 3 қадамнан соң Tensend-тегі барлық
            <br>курстарды қарауыңызға
            <br>болады.<br>
        </h5>
        <button class="w-97 next-step" type="button" id="">Кеттік</button>
    </div>
    <div class="content second-step tab-pane" role="tabpanel" id="step2">
        <img class="tensend-icon" src="{{asset('illustration2.png')}}" alt="">
        <form>
            <div class="form-group">
                <label class="form-label">Телефон нөмеріңіз</label>
                <div class="form-row">
                    <select id="id_select2_example" class="form-control" name="country">
                        @foreach($countries as $country)
                            <option value="{{$country->id}}" data-img_src="{{asset($country->image_path)}}">
                                {{$country->phone_prefix}}
                            </option>
                        @endforeach
                    </select>
                    <input id="phone" class="phone m-b-md form-control" type="text" inputmode="numeric" name="phone"
                           pattern="^\([0-9]{3}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}$">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Құпия сөзіңіз</label>
                <input id="password" class="password form-control" type="password" name="password"
                    pattern="">
            </div>
        <button class="w-97 next-step" type="button" id="sendPhone">Жалғастыру</button>
    </form>
    </div>
</div>
<script src="{{asset('admin/scripts/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('admin/scripts/select2.min.js')}}"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script>
</script>
<script type="text/javascript">
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
</script>
</body>
</html>
