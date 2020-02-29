<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Certificate</title>
    <script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <style>
        /* cyrillic-ext */
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Montserrat Regular'), local('Montserrat-Regular'), url({{ asset('fonts/Montserrat-Regular.ttf') }}) format("truetype");
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
            color: #344356;
        }

        body {
            position: relative;
            width: 29.7cm;
            height: 21.0cm;
        }

        .image {
            position: absolute;
            top: 0;
            left: 0;
            object-fit: cover;
            width: 29.7cm;
            height: 21.0cm;
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
            font-size: 1.5cm;
            font-weight: 600;
        }

        .info-text {
            margin: -1.2cm auto 0;
            width: 6cm;
            text-align: center;
            font-size: 0.3cm;
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
    </div>
</div>


</body>
<script type="text/javascript">
    window.onload = function() {
        window.print();
    }
</script>
</html>



