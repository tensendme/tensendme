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
            margin: 15px auto 80px auto;
            font-size: 20px;
            border: 0;
            -webkit-appearance: none;
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
            -webkit-appearance: none;
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

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            padding-top: 10%; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
            z-index: 1000;
        }

        .fa {
            cursor: pointer;
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border-radius: 15px;
            border: 1px solid #888;
            width: 80%;
            z-index: 1000;
            text-align: center;
        }

        /* The Close Button */
        .close {
            cursor: pointer;
            display: block;
            margin-top: 20px;
            color: #0060fa;
            font-size: 20px;
            font-weight: bold;
        }

        #loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url({{asset('payment/loader.gif')}}) 50% 50% no-repeat rgb(249, 249, 249);
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
        <h6>
            Назар аударыңыз! <br>
            <h7 style="color:darkgray;">Төлем жасаудан алдын картаңыздан интернет-төлемдерге лимитті тексеріп көріңіз.
            </h7>

        </h6>
    </div>
</div>
<!-- The Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <p id="modal-text"></p>
        <img id="modal-img">
        <br>
        <a class="close">Түсінікті</a>
    </div>
</div>
<form id="paymentFormSample" class="container-col">
    <div class="form-group">
        <label class="label-text">Аты жөніңіз
            <i onclick="openModal(1)" class="fa fa-question-circle-o" aria-hidden="true"></i>
        </label>
        <div class="input-container">
            <input data-cp="name" id="card-holder" placeholder="АТЫ ЖӨНІ" type="text" class="form-control w-90">
        </div>
    </div>

    <div class="form-group">
        <label class="label-text">Карта нөмірі
            <i onclick="openModal(2)" class="fa fa-question-circle-o" aria-hidden="true"></i>
        </label>
        <div class="input-container">
            <input id="cc" type="text"
                   placeholder="**** **** **** ****" class="cc form-control w-90">
            <input data-cp="cardNumber" id="realCardNumber" type="hidden">
        </div>
    </div>

    <div class="container-row">
        <div class="form-group">
            <label onclick="openModal(3)" class="label-text same-row">
                CVS-код
                <i class="fa fa-question-circle-o" aria-hidden="true"></i>
            </label>
            <div class="input-container">
                <input placeholder="CVS" id="cvs" data-cp="cvv" type="text" class="form-control text-center w-70">
            </div>
        </div>

        <div class="form-group">
            <label onclick="openModal(4)" class="label-text same-row">
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
<div id="loader" style="display: none"></div>
</body>


<script>

    var cardInfo = [
        {
            id: 1,
            src: '{{asset('payment/card1.svg')}}',
            text: 'Картаңыздың алдыңғы бетінде көрсетілген аты жөніңізді еңгізіңіз'
        },
        {
            id: 2,
            src: '{{asset('payment/card2.svg')}}',
            text: 'Картаңыздың алдыңғы бетінде көрсетілген 16-санды нөмірді еңгізіңіз'
        },
        {
            id: 3,
            src: '{{asset('payment/card3.svg')}}',
            text: 'Картаңыздың артқы бетінде көрсетілген 3-санды нөмірді еңгізіңіз'
        },
        {
            id: 4,
            src: '{{asset('payment/card4.svg')}}',
            text: 'Картаңыздың алдыңғы бетінде көрсетілген ай мен жылды еңгізіңіз'
        },
    ];

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
        const urlParams = new URLSearchParams(window.location.search);
        const token = urlParams.get('token');
        var name = $('#realCardNumber').val();
        var result = checkout.createCryptogramPacket();
        let stateObj = {id: "100"};
        window.history.replaceState(stateObj, "Төлем жасау", "/subscribe");
        if (result.success) {
            // сформирована криптограмма
            loader();
            var myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/json");
            myHeaders.append("Authorization", `Bearer ${token}`);

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
            // fetch("http://192.168.0.102:8000/api/v1/send/crypto", requestOptions)
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

                        window.open(result.url + "?" + 'transaction_id=' + result.transaction_id, "_self")
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


    var modal = $("#myModal");

    var span = document.getElementsByClassName("close")[0];

    var modalText = $('#modal-text');
    var modalImg = $('#modal-img');

    // When the user clicks the button, open the modal
    function openModal(id) {
        el = cardInfo.find((el) => el.id == id)

        if (el) {
            modalText.html(el.text);
            modalImg.attr('src', el.src);
            modal.show();
        }

    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.hide();
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.hide();
        }
    };

    function loader() {
        var x = document.getElementById("loader");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

</script>
</html>
