<!DOCTYPE html>
<html>


<head>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://widget.cloudpayments.ru/bundles/checkout"></script>
    <script src="{{asset('front/js/jquery-3.3.1.min.js')}}"
            crossorigin="anonymous"></script>
    <script src="{{asset('js/jquery.inputmask.min.js')}}"></script>
    <title>Payment</title>
    <style>
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Montserrat Regular'), local('Montserrat-Regular'), url({{ storage_path('fonts/Montserrat-Regular.ttf') }}) format("truetype");
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        /* cyrillic */
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Montserrat Regular'), local('Montserrat-Regular'), url({{ asset('fonts/Montserrat-Regular.ttf') }}) format("truetype");;
            unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        /* vietnamese */
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Montserrat Regular'), local('Montserrat-Regular'), url({{ asset('fonts/Montserrat-Regular.ttf') }}) format("truetype");
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Montserrat Regular'), local('Montserrat-Regular'), url({{ asset('fonts/Montserrat-Regular.ttf') }}) format("truetype");
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Montserrat Regular'), local('Montserrat-Regular'), url({{ asset('fonts/Montserrat-Regular.ttf') }}) format("truetype");
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* cyrillic-ext */
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: local('Montserrat SemiBold'), local('Montserrat-SemiBold'), url({{ asset('fonts/Montserrat-SemiBold.ttf') }}) format("truetype");
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        /* cyrillic */
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: local('Montserrat SemiBold'), local('Montserrat-SemiBold'), url({{ asset('fonts/Montserrat-SemiBold.ttf') }}) format("truetype");
            unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        /* vietnamese */
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: local('Montserrat SemiBold'), local('Montserrat-SemiBold'), url({{ asset('fonts/Montserrat-SemiBold.ttf') }}) format("truetype");
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: local('Montserrat SemiBold'), local('Montserrat-SemiBold'), url({{ asset('fonts/Montserrat-SemiBold.ttf') }}) format("truetype");
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: local('Montserrat SemiBold'), local('Montserrat-SemiBold'), url({{ asset('fonts/Montserrat-SemiBold.ttf') }}) format("truetype");
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

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

        .img-tensend {
            width: 80px;
            height: auto;
            margin: 20px auto;
        }

        .container > .first-row {
            flex: 1;
        }

        .container > .second-row {
            flex: 1;
            text-align: center;
        }

        .too-info {
            font-size: 12px;
        }

        .form-group {
            flex: 1;
        }

        .w-100 {
            width: 100%;
        }

        .w-90 {
            width: 90%;
        }

        .w-70 {
            width: 70%;
        }

        .w-50 {
            width: 50%;
        }

        .w-40 {
            width: 40%;
        }

        .w-60 {
            width: 60%;
        }

        .submit-btn {
            background-color: #004DC9;
            height: 50px;
            color: white;
            margin: 15px auto 50px;
            font-size: 20px;
            border: 0;
            -webkit-box-shadow: 0px 1px 23px 19px rgba(0, 77, 201, 0.21);
            box-shadow: 0px 1px 23px 19px rgba(0, 77, 201, 0.17);
            border-radius: 15px;
        }

        .form-control {
            border-radius: 5px;
            height: 60px;
            padding: 0 15px;
            font-size: 15px;
            text-transform: uppercase;
            background-color: white;
            border: 0;
            outline: none;
            -webkit-box-shadow: 0px 1px 23px 19px rgba(0, 77, 201, 0.04);
            box-shadow: 0px 1px 23px 19px rgba(0, 77, 201, 0.04);
        }

        .label-text {
            margin: 10px 0 0 20px;
            display: inline-block;
            font-weight: 600;
        }

        .same-row {
            height: 40px;
        }

        .input-container {
            margin: 20px 0;
        }

        .w-97 {
            width: 97%;
        }

        .text-center {
            text-align: center;
        }
    </style>
<body>
<h3 class="title">Төлем</h3>

<div class="container">
    <div class="first-row">
        <h4>
            ЖШС «Tensend»
        </h4>
        <p class="too-info">
            БИН: 190440000695
            <br>
            Мекен-жай: Алматы қ.,
            <br>
            Райымбек даңғылы, 481В
            <br>
            Тел: +77076941411
        </p>
    </div>
    <div class="second-row">
        <img class="img-tensend" src="{{asset('payment/tensendpayment.png')}}">
    </div>
</div>
<div class="container">
    <div class="first-row">
        <h4>
            {{$subscription_type->name}}
        </h4>
        <h2>
            {{$subscription_type->price}} KZT
        </h2>
    </div>
</div>

<form id="paymentFormSample" class="container-col">
    <div class="form-group">
        <label class="label-text">Аты жөніңіз
            <i class="fa fa-question-circle-o" aria-hidden="true"></i>
        </label>
        <div class="input-container">
            <input data-cp="name" id="card-holder" placeholder="АТЫ ЖӨНІ" type="text" class="form-control w-90">
        </div>
    </div>

    <div class="form-group">
        <label class="label-text">Карта нөмірі
            <i class="fa fa-question-circle-o" aria-hidden="true"></i>
        </label>
        <div class="input-container">
            <input id="cc" type="text"
                   placeholder="**** **** **** ****" class="cc form-control w-90">
            <input data-cp="cardNumber" id="realCardNumber" type="hidden">
        </div>
    </div>

    <div class="container-row">
        <div class="form-group">
            <label class="label-text same-row">
                CVS-код
                <i class="fa fa-question-circle-o" aria-hidden="true"></i>
            </label>
            <div class="input-container">
                <input placeholder="CVS" id="cvs" data-cp="cvv" type="text" class="form-control text-center w-70">
            </div>
        </div>

        <div class="form-group">
            <label class="label-text same-row">
                Жарамдылық
                мерзімі
                <i class="fa fa-question-circle-o" aria-hidden="true"></i>
            </label>
            <div class="container">
                <div class="input-container">
                    <input data-cp="expDateMonth" placeholder="Ай" id="month" type="text"
                           class="form-control text-center w-50">
                </div>
                <div class="input-container">
                    <input data-cp="expDateYear" placeholder="Жыл" id="year" type="text"
                           class="form-control text-center w-50">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <input class="w-97 submit-btn" type="submit" value="Төлем жасау">
    </div>
</form>
</body>


<script>

    var checkout = new cp.Checkout(
        "pk_5ca541f82448e11afb98b5c1a3ffa",
        document.getElementById('paymentFormSample'));

    $(document).ready(function () {

        var form = $('#paymentFormSample');

        form.on('submit', (e) => {
            e.preventDefault();
            createCryptogram();
            return false;
        });
        var cc = $('#cc');
        cc.inputmask("9999 9999 9999 9999");
        cc.on('input', (e) => {
            var val = cc.val();
            val = val.split(' ').join('');
            $('#realCardNumber').val(val);
        });
        var year = $('#year');
        year.inputmask("99");
        var month = $('#month');
        month.inputmask("99");
        var cvs = $('#cvs');
        cvs.inputmask("999");
    });

    function createCryptogram() {
        var name = $('#realCardNumber').val();
        var result = checkout.createCryptogramPacket();
        console.log(result);

        if (result.success) {
            // сформирована криптограмма
            console.log(result.packet);
            var myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/json");
            myHeaders.append("Authorization", "{{$token}}");

            var raw = JSON.stringify({
                "Amount": "{{$subscription_type->price}}",
                "Name": name,
                "CardCryptogramPacket": result.packet,
                "subscription_type_id": "{{$subscription_type->id}}"
            });

            var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: raw,
                redirect: 'follow'
            };
            fetch("https://tensend.me/api/v1/send/crypto", requestOptions)
                .then(response => response.json())
                .then(result => {
                    console.log(result);
                    if (result.hasOwnProperty('PaReq')) {
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
                    else {
                        window.location.href = result.url + "?" + 'transaction_id=' + result.transaction_id;
                    }
                })
                .catch(error => console.log('error', error));
        }
        else {
            var msgs = result.messages;
            if (msgs.hasOwnProperty('cardNumber'))
                alert(msgs.cardNumber);
            if (msgs.hasOwnProperty('name'))
                alert(msgs.name);
            if (msgs.hasOwnProperty('cvv'))
                alert(msgs.cvv);
            if (msgs.hasOwnProperty('expDateMonth'))
                alert(msgs.expDateMonth);
            if (msgs.hasOwnProperty('expDateYear'))
                alert(msgs.expDateYear)
        }
    }
</script>
</html>