<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Certificate</title>
    <script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,600,600i&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <style>

        @page :first {
            margin: 0;
        }

        @page :left {
            margin: 0;
        }

        @page :right {
            margin: 0;
        }

        @media print {

            html, body {
                height: 100%;
                margin: 0 !important;
                padding: 0 !important;
                overflow: hidden;
                -webkit-print-color-adjust: exact;
            }

        }

        @media print {
            body * {
                visibility: hidden;
            }

            #section-to-print, #section-to-print * {
                visibility: visible;
            }

            #section-to-print {
                position: absolute;
                left: 0;
                top: 0;
            }
        }

        * {
            font-family: 'Montserrat';
            /*color: #344356;*/
        }

        body {
           position: relative;
           width: 29.7cm;
           height: 100%;
        }

        .image {
            position: absolute;
            top: 0;
            left: 0;
            object-fit: cover;
            width: 29.7cm;
            height: 23.0cm;
        }

        .container {
            position: absolute;
            width: 100%;
            text-align: center;
        }

        .inner-container {
            position: relative;
        }

        .certificate {
            font-weight: bold;
            font-size: 1.3cm;
            margin-top: 6cm;
        }

        .middle-text {
            margin-top: -1.2cm;
            font-size: 0.350cm;
        }

        .given-to {
            font-size: 0.5cm;
            font-weight: 400;
        }

        .full-name {
            font-size: 0.85cm;
            font-weight: 600;
            margin-top: -0.3cm;
        }

        .info-text {
            margin: -0.7cm auto 0;
            width: 6cm;
            text-align: center;
            font-size: 0.3cm;
        }

        .author {
            font-size: 0.7cm;
            font-weight: 600;
        }

        .certificateId {
            margin: 220px 980px 0 5px;
            width: 250px;
            text-align: left;
        }
        .pId {
            position: relative;
            color: #ffffff;
            font-size: 0.9cm;
            font-weight: 500;
            letter-spacing: 0.4px;
        }
    </style>
</head>
<body>

<div class="container" id="section-to-print">
    <img class="image" src="{{asset('cert.png')}}">
    <div class="inner-container">
        <p class="certificate">{{$certificate}}</p>
        <p class="middle-text">{{$middleText}}</p>

        <p class="given-to">{{$given}}</p>

        <p class="full-name">{{$fullName}}</p>

        <p class="info-text">
            {{$infoText}}
        </p>
        <p class="author">{{$author}}</p>
        <div class="certificateId">
            <p class="pId">{{$id}}</p>
        </div>

    </div>
</div>


</body>
<script type="text/javascript">
    $(document).ready(() => {
        window.print();
    });
</script>
</html>



