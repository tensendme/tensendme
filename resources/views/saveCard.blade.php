<!DOCTYPE html>

<head>
    <script src="https://widget.cloudpayments.ru/bundles/checkout"></script>
    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <title>Payment</title>
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
        }

        html, body {
            min-height: 100%;
            font-family: 'Open sans', sans-serif;
        }

        body {
            background: linear-gradient(50deg, #f3c680, rgba(161, 227, 226, 1));
        }

        /*-------------------- Buttons --------------------*/
        .btn {
            display: block;
            background: #bded7d;
            color: #fff;
            text-decoration: none;
            margin: 20px 0;
            padding: 15px 15px;
            border-radius: 5px;
            position: relative;
        }

        .btn::after {
            content: '';
            position: absolute;
            z-index: 1;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transition: all 0.2s ease-in-out;
            box-shadow: inset 0 3px 0 rgba(0, 0, 0, 0), 0 3px 3px rgba(0, 0, 0, .2);
            border-radius: 5px;
        }

        .btn:hover::after {
            background: rgba(0, 0, 0, 0.1);
            box-shadow: inset 0 3px 0 rgba(0, 0, 0, 0.2);
        }

        /*-------------------- Form --------------------*/
        .form fieldset {
            border: none;
            padding: 0;
            padding: 10px 0;
            position: relative;
            clear: both;
        }

        .form fieldset.fieldset-expiration {
            float: left;
            width: 60%;
        }

        .form fieldset.fieldset-expiration .select {
            width: 84px;
            margin-right: 12px;
            float: left;
        }

        .form fieldset.fieldset-ccv {
            clear: none;
            float: right;
            width: 86px;
        }

        .form fieldset label {
            display: block;
            text-transform: uppercase;
            font-size: 11px;
            color: rgba(0, 0, 0, .6);
            margin-bottom: 5px;
            font-weight: bold;
            font-family: Inconsolata;
        }

        .form fieldset input, .form fieldset .select {
            width: 100%;
            height: 38px;
            color: #333;
            padding: 10px;
            border-radius: 5px;
            font-size: 15px;
            outline: none !important;
            border: 1px solid rgba(0, 0, 0, 0.3);
            box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.2);
        }

        .form fieldset input.input-cart-number, .form fieldset .select.input-cart-number {
            width: 82px;
            display: inline-block;
            margin-right: 8px;
        }

        .form fieldset input.input-cart-number:last-child, .form fieldset .select.input-cart-number:last-child {
            margin-right: 0;
        }

        .form fieldset .select {
            position: relative;
        }

        .form fieldset .select::after {
            content: '';
            border-top: 8px solid #222;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            position: absolute;
            z-index: 2;
            top: 14px;
            right: 10px;
            pointer-events: none;
        }

        .form fieldset .select select {
            appearance: none;
            position: absolute;
            padding: 0;
            border: none;
            width: 100%;
            outline: none !important;
            top: 6px;
            left: 6px;
            background: none;
        }

        .form fieldset .select select :-moz-focusring {
            color: transparent;
            text-shadow: 0 0 0 #000;
        }

        .form button {
            width: 100%;
            outline: none !important;
            background: linear-gradient(180deg, #49a09b, #3d8291);
            text-transform: uppercase;
            font-weight: bold;
            border: none;
            box-shadow: none;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            margin-top: 90px;
        }

        .form button .fa {
            margin-right: 6px;
        }

        /*-------------------- Checkout --------------------*/
        .checkout {
            margin: 150px auto 30px;
            position: relative;
            width: 460px;
            background: white;
            border-radius: 15px;
            padding: 160px 45px 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, .1);
        }

        /*-------------------- Credit Card --------------------*/
        .credit-card-box {
            perspective: 1000;
            width: 400px;
            height: 280px;
            position: absolute;
            top: -112px;
            left: 50%;
            transform: translateX(-50%);
        }

        .credit-card-box:hover .flip, .credit-card-box.hover .flip {
            transform: rotateY(180deg);
        }

        .credit-card-box .front, .credit-card-box .back {
            width: 400px;
            height: 250px;
            border-radius: 15px;
            backface-visibility: hidden;
            background: linear-gradient(135deg, #bd6772, #53223f);
            position: absolute;
            color: #fff;
            font-family: Inconsolata;
            top: 0;
            left: 0;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.3);
        }

        .credit-card-box .front::before, .credit-card-box .back::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: url('http://cdn.flaticon.com/svg/44/44386.svg') no-repeat center;
            background-size: cover;
            opacity: 0.05;
        }

        .credit-card-box .flip {
            transition: 0.6s;
            transform-style: preserve-3d;
            position: relative;
        }

        .credit-card-box .logo {
            position: absolute;
            top: 9px;
            right: 20px;
            width: 60px;
        }

        .credit-card-box .logo svg {
            width: 100%;
            height: auto;
            fill: #fff;
        }

        .credit-card-box .front {
            z-index: 2;
            transform: rotateY(0deg);
        }

        .credit-card-box .back {
            transform: rotateY(180deg);
        }

        .credit-card-box .back .logo {
            top: 185px;
        }

        .credit-card-box .chip {
            position: absolute;
            width: 60px;
            height: 45px;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #ddccf0 0%, #d1e9f5 44%, #f8ece7 100%);
            border-radius: 8px;
        }

        .credit-card-box .chip::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
            border: 4px solid rgba(128, 128, 128, .1);
            width: 80%;
            height: 70%;
            border-radius: 5px;
        }

        .credit-card-box .strip {
            background: linear-gradient(135deg, #404040, #1a1a1a);
            position: absolute;
            width: 100%;
            height: 50px;
            top: 30px;
            left: 0;
        }

        .credit-card-box .number {
            position: absolute;
            margin: 0 auto;
            top: 103px;
            left: 19px;
            font-size: 38px;
        }

        .credit-card-box label {
            font-size: 10px;
            letter-spacing: 1px;
            text-shadow: none;
            text-transform: uppercase;
            font-weight: normal;
            opacity: 0.5;
            display: block;
            margin-bottom: 3px;
        }

        .credit-card-box .card-holder, .credit-card-box .card-expiration-date {
            position: absolute;
            margin: 0 auto;
            top: 180px;
            left: 19px;
            font-size: 22px;
            text-transform: capitalize;
        }

        .credit-card-box .card-expiration-date {
            text-align: right;
            left: auto;
            right: 20px;
        }

        .credit-card-box .ccv {
            height: 36px;
            background: #fff;
            width: 91%;
            border-radius: 5px;
            top: 110px;
            left: 0;
            right: 0;
            position: absolute;
            margin: 0 auto;
            color: #000;
            text-align: right;
            padding: 10px;
        }

        .credit-card-box .ccv label {
            margin: -25px 0 14px;
            color: #fff;
        }

    </style>
</head>
<body>

<div class="checkout">
    <div class="credit-card-box">
        <div class="flip">
            <div class="front">
                <div class="chip"></div>
                <div class="logo">
                    <svg version="1.1" id="visa" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834"
                         style="enable-background:new 0 0 47.834 47.834;">
                        <g>
                            <g>
                                <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                         c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                         c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                         M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                         c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                         c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                         l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                         C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                         C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                         c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                         h-3.888L19.153,16.8z"/>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="number"></div>
                <div class="card-holder">
                    <label>Card holder</label>
                    <div></div>
                </div>
                <div class="card-expiration-date">
                    <label>Expires</label>
                    <div></div>
                </div>
            </div>
            <div class="back">
                <div class="strip"></div>
                <div class="logo">
                    <svg version="1.1" id="visa" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834"
                         style="enable-background:new 0 0 47.834 47.834;">
                        <g>
                            <g>
                                <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                         c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                         c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                         M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                         c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                         c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                         l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                         C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                         C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                         c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                         h-3.888L19.153,16.8z"/>
                            </g>
                        </g>
                    </svg>

                </div>
                <div class="ccv">
                    <label>CCV</label>
                    <div></div>
                </div>
            </div>
        </div>
    </div>
    <form class="form" id="paymentFormSample" autocomplete="off" novalidate
          onsubmit="createCryptogram(); return false;">
        <fieldset>
            <label for="card-number">Card Number</label>
            <input id="real-card-number" type="hidden" data-cp="cardNumber">
            <input type="number" id="card-number" onkeyup="putIntoCardNumber()" class="input-cart-number"
                   maxlength="4"/>
            <input type="number" id="card-number-1" onkeyup="putIntoCardNumber()" class="input-cart-number"
                   maxlength="4"/>
            <input type="number" id="card-number-2" onkeyup="putIntoCardNumber()" class="input-cart-number"
                   maxlength="4"/>
            <input type="number" id="card-number-3" onkeyup="putIntoCardNumber()" class="input-cart-number"
                   maxlength="4"/>
        </fieldset>
        <fieldset>
            <label for="card-holder">Card holder</label>
            <input type="text" id="card-holder"  data-cp="name"/>
        </fieldset>
        <fieldset class="fieldset-expiration">
            <label for="card-expiration-month">Expiration date</label>
            <div class="select">
                <select id="card-expiration-month" data-cp="expDateMonth">
                    <option></option>
                    <option>01</option>
                    <option>02</option>
                    <option>03</option>
                    <option>04</option>
                    <option>05</option>
                    <option>06</option>
                    <option>07</option>
                    <option>08</option>
                    <option>09</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                </select>
            </div>
            <div class="select">
                <select id="card-expiration-year" data-cp="expDateYear">
                    <option></option>
                    <option>2016</option>
                    <option>2017</option>
                    <option>2018</option>
                    <option>2019</option>
                    <option>2020</option>
                    <option>2021</option>
                    <option>2022</option>
                    <option>2023</option>
                    <option>2024</option>
                    <option>2025</option>
                </select>
            </div>
        </fieldset>
        <fieldset class="fieldset-ccv">
            <label for="card-ccv">CCV</label>
            <input type="text" id="card-ccv" data-cp="cvv"  maxlength="3"/>
        </fieldset>
        {{--        <button class="btn"><i class="fa fa-lock" onclick="getFormData()"></i> submit</button>--}}
        <button class="btn" onclick="putIntoCardNumber()">submit</button>

    </form>
    {{--    <button class="btn" onclick="test()">submit 3</button>--}}


</div>
{{--<div class="card-body p-0 pb-3 text-center">--}}
{{--    <form id="paymentFormSample" autocomplete="off" onsubmit="createCryptogram(); return false;">--}}
{{--        <label>--}}
{{--            <input type="text" data-cp="cardNumber" value="5169493137327758">--}}
{{--        </label>--}}
{{--        <label>--}}
{{--            <input type="text" data-cp="expDateMonth" value="04">--}}
{{--        </label>--}}
{{--        <label>--}}
{{--            <input type="text" data-cp="expDateYear" value="21">--}}
{{--        </label>--}}
{{--        <label>--}}
{{--            <input type="text" data-cp="cvv" value="123">--}}
{{--        </label>--}}
{{--        <label>--}}
{{--            <input type="text" data-cp="name" value="KASIYLIY VASIYLIY">--}}
{{--        </label>--}}

{{--        <button type="submit">Pay</button>--}}
{{--    </form>--}}
{{--</div>--}}

{{--<form name="downloadForm" action="https://demo.cloudpayments.ru/acs" method="POST">--}}
{{--    <input type="hidden" name="PaReq" value="+/eyJNZXJjaGFudE5hbWUiOm51bGwsIkZpcnN0U2l4IjoiNTE2OTQ5IiwiTGFzdEZvdXIiOiI3NzU4IiwiQW1vdW50IjoxMDAuMCwiQ3VycmVuY3lDb2RlIjoiS1pUIiwiRGF0ZSI6IjIwMjAtMDItMDVUMDA6MDA6MDArMDM6MDAiLCJDdXN0b21lck5hbWUiOm51bGwsIkN1bHR1cmVOYW1lIjoicnUtUlUifQ==">--}}
{{--    <input type="hidden" name="MD" value="291915274">--}}
{{--    <input type="hidden" name="TermUrl" value="https://vk.com/kd_dulatovich">--}}
{{--</form>--}}
{{--</body>--}}


<script>


    function putIntoCardNumber() {
        $('#real-card-number').val($('#card-number').val() + $('#card-number-1').val() + $('#card-number-2').val() + $('#card-number-3').val());
    }

    function getFormData() {
        console.log(document.getElementById('paymentFormSample'));
    }

    // function test() {
    //     var myHeaders = new Headers();
    //     myHeaders.append("Content-Type", "application/json");
    //     myHeaders.append("Authorization", "Basic cGtfNWNhNTQxZjgyNDQ4ZTExYWZiOThiNWMxYTNmZmE6Y2MwNmQ2Yjc2MTRkNDgzNDgwOWRmZGQ3NTU1MjdmMWE=");
    //
    //     var raw = JSON.stringify({"Amount":100,"Currency":"KZT","IpAddress":"192.168.0.115","Name":"DAUREN KAKIMBEKOV","CardCryptogramPacket":"015169497758210402J0lKi7K5RgKLmxacsXO+JrF7hNT1uI3C6NEiGmgScbazmbeTGQ9dI60sRc2ltwXl9XzjHJyGjar0+VSoK1UrouZxuOjlNxlb/RMZlMe98you1im63SWvUTjmz/kbcaCVatfzBMprCWmuocC55iDBWf4Z/8CX+bVVF2j2A1NPE8f23uViLgYmCOPbsn+pJNwaU6Nz2IVO/lA9WX8/+WD6wtdhQNShRHYp4Qyrnpy+YXKBOEFmOJZs2FfED4meTGa3SRZNebiLuSVEIx/F/+kpUkJX0WUQcV227bEXPL5Q+2rFKzZ7I/7YTCMZt4IhEJFE9g6MdXjjvpwkQfGF5TQ9LA=="});
    //
    //     var requestOptions = {
    //         method: 'POST',
    //         headers: myHeaders,
    //         body: raw,
    //         redirect: 'follow',
    //         mode: 'no-cors'
    //
    //     };
    //
    //     fetch("https://api.cloudpayments.ru/payments/cards/charge", requestOptions)
    //         .then(response => response.text())
    //         .then(result => console.log(result))
    //         .catch(error => console.log('error', error));
    // }
    var checkout = new cp.Checkout(
        // public id из личного кабинета
        "pk_5ca541f82448e11afb98b5c1a3ffa",

        document.getElementById('paymentFormSample'));

    // тег, содержащий поля данных карты

    var createCryptogram = function () {
        var name = document.getElementById('card-holder').value;

        var result = checkout.createCryptogramPacket();
        console.log(result);

        if (result.success) {
            // сформирована криптограмма
            // alert(result.packet);
            console.log(result.packet);
            var myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/json");
            myHeaders.append("Authorization", "{{$token}}");


            var raw = JSON.stringify({"Amount":"0.01","Name":name,"CardCryptogramPacket":result.packet});

            var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: raw,
                redirect: 'follow'
            };

            // fetch("http://127.0.0.1:8000/api/v1/send/crypto", requestOptions)
            fetch("https://tensend.me/api/v1/send/crypto", requestOptions)
                .then(response => response.json())
                .then(result => {
                    console.log(result);
                    if (result.hasOwnProperty('PaReq'))
                    {
                        // submitForm();
                        console.log(result.PaReq);


                        var form = document.createElement("FORM");
                        form.setAttribute("name", "form");
                        form.setAttribute("type", "hidden");
                        form.setAttribute("action", result.AcsUrl);
                        form.setAttribute("method", "POST");


                        var input1 = document.createElement("input");
                        input1.setAttribute("name", "MD");
                        input1.setAttribute("type", "hidden");
                        input1.setAttribute("value", result.TransactionId);
                        var input2 = document.createElement("input");
                        input2.setAttribute("name", "PaReq");
                        input2.setAttribute("type", "hidden");
                        input2.setAttribute("value", result.PaReq);
                        var input3 = document.createElement("input");
                        input3.setAttribute("name", "TermUrl");
                        input3.setAttribute("type", "hidden");
                        input3.setAttribute("value", result.TermUrl);

                        form.appendChild(input1);
                        form.appendChild(input2);
                        form.appendChild(input3);

                        document.body.appendChild(form).submit();
                    }
                    else{
                        window.location.href = result.url + "?" + 'transaction_id=' + result.transaction_id;
                    }
                })
                .catch(error => console.log('error', error));



        }

        else {
            alert(result.messages);
        }
    };


    $('.input-cart-number').on('keyup change', function () {
        $t = $(this);

        if ($t.val().length > 3) {
            $t.next().focus();
        }

        var card_number = '';
        $('.input-cart-number').each(function () {
            card_number += $(this).val() + ' ';
            if ($(this).val().length == 4) {
                $(this).next().focus();
            }
        })

        $('.credit-card-box .number').html(card_number);
    });

    $('#card-holder').on('keyup change', function () {
        $t = $(this);
        $('.credit-card-box .card-holder div').html($t.val());
    });

    $('#card-holder').on('keyup change', function () {
        $t = $(this);
        $('.credit-card-box .card-holder div').html($t.val());
    });

    $('#card-expiration-month, #card-expiration-year').change(function () {
        m = $('#card-expiration-month option').index($('#card-expiration-month option:selected'));
        m = (m < 10) ? '0' + m : m;
        y = $('#card-expiration-year').val().substr(2, 2);
        $('.card-expiration-date div').html(m + '/' + y);
    })

    $('#card-ccv').on('focus', function () {
        $('.credit-card-box').addClass('hover');
    }).on('blur', function () {
        $('.credit-card-box').removeClass('hover');
    }).on('keyup change', function () {
        $('.ccv div').html($(this).val());
    });

    /*function getCreditCardType(accountNumber) {
      if (/^5[1-5]/.test(accountNumber)) {
        result = 'mastercard';
      } else if (/^4/.test(accountNumber)) {
        result = 'visa';
      } else if ( /^(5018|5020|5038|6304|6759|676[1-3])/.test(accountNumber)) {
        result = 'maestro';
      } else {
        result = 'unknown'
      }
      return result;
    }

    $('#card-number').change(function(){
      console.log(getCreditCardType($(this).val()));
    })*/


</script>

