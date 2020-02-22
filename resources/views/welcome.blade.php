<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tensend</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('front/fonts/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/bootstrap-datepicker.css')}}">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">

    <link rel="stylesheet" href="{{asset('front/fonts/flaticon/font/flaticon.css')}}">

    <link rel="stylesheet" href="{{asset('front/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/jquery.fancybox.min.css')}}">


    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
    <style>
        .tensend-logo {
            width: 320px;
            height: 120px;
            margin-top: -60px;
        }

        .smart_phone {
            /*height: 250px;*/
            /*width: 100%;*/
        }

        .downloadUrl {
            width:40px;
            height:40px;
        }
        .downloadUrlApple {
            width:45px;
            height:40px;
        }
        #downloadUrlBlock {
           background-color: #0a0c0d;
        }
        #downloadUrlSpanIos {
            color: white;
            font-size: 20px;
            letter-spacing: 0.5px;
            font-style: normal;

        }
        #downloadUrlSpanAndroid {
            color: white;
            font-size: 20px;
            font-style: normal;
            letter-spacing: -1px;
        }
    </style>
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

<div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->


    <div class="site-navbar-wrap">

        <div class="site-navbar site-navbar-target js-sticky-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-6 col-lg-2">
                        <h1 class="my-0 site-logo"><a href="/">Tensend</a></h1>
                    </div>
                    <div class="col-6 col-lg-10">
                        <nav class="site-navigation text-right" role="navigation">
                            <div class="container">

                                <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3 "><a href="#"
                                                                                               class="site-menu-toggle js-menu-toggle text-black">
                                        <span class="icon-menu h3"></span>
                                    </a></div>

                                <ul class="site-menu main-menu js-clone-nav d-none d-lg-block">
                                    <li><a href="#home-section" class="nav-link">@lang('messages.mainPage')</a></li>
                                    <li><a href="#features-section" class="nav-link">@lang('messages.aboutPage')</a></li>
                                    {{--                                    <li><a href="#about-section" class="nav-link">О нас</a></li>--}}
                                    <li><a href="#testimonial-section" class="nav-link">@lang('messages.politicPage')</a></li>
                                    <li><a href="#contact-section" class="nav-link">@lang('messages.contactPage')</a></li>
                                    <li>
                                        <a class="nav-link dropdown-toggle" id="navbarDropdown"
                                           role="button" data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                            @lang('messages.language')
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{route('locale.change', ['locale' => 'kz'])}}">KZ</a>
                                            <a class="dropdown-item" href="{{route('locale.change', ['locale' => 'ru'])}}">RU</a>
                                        </div>
                                    </li>
                                    <li>
                                        @auth
                                            <a href="{{ url('/home') }}" class="nav-link">@lang('messages.enterToSystem')</a>
                                        @else
                                            <a href="{{ route('login') }}" class="nav-link">@lang('messages.login')</a>
                                        @endauth
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- END .site-navbar-wrap -->


    <div class="site-section" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mb-5">
                    <img class="mb-4 tensend-logo" src="{{asset('10Send.png')}}" alt="Tensend">
                    <p class="text-white mb-5">@lang('messages.text1')
                    </p>
                    <div id="downloadUrlDiv">
                    <a href="#" class="btn btn-white px-2 py-1" id="downloadUrlBlock">
                            <img src="{{asset('google.png')}}" class="downloadUrl" alt="Доступно в">
                        <span id="downloadUrlSpanAndroid">Google Play</span>
                    </a>
                        <a href="#" class="btn btn-white px-2 py-1" id="downloadUrlBlock">
                            <img src="{{asset('apple.png')}}" class="downloadUrlApple" alt="Доступно в">
                            <span id="downloadUrlSpanIos">App Store</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <img src="{{asset('front/images/Tensend.png')}}" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <div class="site-section bg-light" id="features-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-7">
                    <h2 class="heading">@lang('messages.aboutHead')</h2>
                    <p>@lang('messages.aboutText')
                    </p>
                    <a href="{{asset('docs/Payment.pdf')}}">@lang('messages.politicsHead')</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-book"></span>
              </span>
                        <h3>@lang('messages.educationHead')</h3>
                        <p>@lang('messages.educationText')</p>
                    </div>

                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-bar-chart"></span>
              </span>
                        <h3>@lang('messages.statisticsHead')</h3>
                        <p>@lang('messages.statisticsText')
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-attach_money"></span>
              </span>
                        <h3>@lang('messages.getCashHead')</h3>
                        <p>@lang('messages.getCashText')
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-first-order"></span>
              </span>
                        <h3>@lang('messages.HoaxesHead')</h3>
                        <p>@lang('messages.HoaxesText')
                    </div>

                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-star"></span>
              </span>
                        <h3>@lang('messages.marketHead')</h3>
                        <p>@lang('messages.marketText')</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-monetization_on"></span>
              </span>
                        <h3>@lang('messages.additionalInfoHead')</h3>
                        <p>@lang('messages.additionalInfoText')</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="site-section bg-light" id="features-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-7">
                    <h2 class="heading">@lang('messages.text2')</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-attach_money"></span>
              </span>
                        <h3>@lang('messages.findMoneyHead')</h3>
                        <p>@lang('messages.findMoneyText')</p>
                    </div>

                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-people_outline"></span>
              </span>
                        <h3>@lang('messages.findStudentHead')</h3>
                        <p>@lang('messages.findStudentText')
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-plus"></span>
              </span>
                        <h3>@lang('messages.enterCommunityHead')</h3>
                        <p>@lang('messages.enterCommunityText')
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section bg-light" id="features-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-7">
                    <h2 class="heading">@lang('messages.text3')</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-event_note"></span>
              </span>
                        <h3>@lang('messages.planCourseHead')</h3>
                        <p>@lang('messages.planCourseText')</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-camera"></span>
              </span>
                        <h3>@lang('messages.writeVideoHead')</h3>
                        <p>@lang('messages.writeVideoText')
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-camera_front"></span>
              </span>
                        <h3>@lang('messages.newCourseHead')</h3>
                        <p>@lang('messages.newCourseText')
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    <div class="site-section">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row mb-5">--}}
    {{--                <div class="col-md-7">--}}
    {{--                    <h2 class="heading">Скриншоты</h2>--}}
    {{--                    <p>Эти виды вы можете увидеть используя Tensend</p>--}}
    {{--                    <p class="mb-3">--}}
    {{--                        <a href="#" class="customNextBtn">Предыдущий</a>--}}
    {{--                        <span class="mx-2">/</span>--}}
    {{--                        <a href="#" class="customPrevBtn">Следующий</a>--}}
    {{--                    </p>--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--            <div class="owl-carousel slide-one-item">--}}
    {{--                <img src="{{asset('front/images/img_1.jpg')}}" alt="Image" class="img-fluid">--}}
    {{--                <img src="{{asset('front/images/img_2.jpg')}}" alt="Image" class="img-fluid">--}}
    {{--                <img src="{{asset('front/images/img_3.jpg')}}" alt="Image" class="img-fluid">--}}
    {{--                <img src="{{asset('front/images/img_4.jpg')}}" alt="Image" class="img-fluid">--}}
    {{--                <img src="{{asset('front/images/img_5.jpg')}}" alt="Image" class="img-fluid">--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div class="site-section bg-light" id="features-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-7">
                    <h2 class="heading">@lang('messages.text5')</h2>
                </div>
                <div class="author  d-lg-flex" id="about-section">
                    <div class="bg-img" style="background-image: url('{{asset('front/images/author_1.jpg')}}');"></div>
                    <div class="text">
                        <h3>@lang('messages.courseLessonsHead')</h3>
                        <p>@lang('messages.courseLessonsText')
                        </p>
                    </div>
                </div>
                <div class="author d-lg-flex mt-4" id="about-section">
                    <div class="bg-img" style="background-image: url('{{asset('front/images/author_1.jpg')}}');"></div>
                    <div class="text">
                        <h3>@lang('messages.courseAccessHead')</h3>
                        <p>@lang('messages.courseAccessText')
                        </p>
                    </div>
                </div>
                <div class="author d-lg-flex mt-4" id="about-section">
                    <div class="bg-img" style="background-image: url('{{asset('front/images/author_1.jpg')}}');"></div>
                    <div class="text">
                        <h3>@lang('messages.certifiHead')</h3>
                        <p>@lang('messages.certifiText')
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section bg-light" id="features-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-7">
                    <h2 class="heading">
                        @lang('messages.CRMHead')</h2>
                    <p>@lang('messages.CRMText')
                    </p>
                </div>
                <div class="author  d-lg-flex" id="about-section">
                    <div class="text">
                        <h3>@lang('messages.onlinePayHead')</h3>
                        <p>@lang('messages.onlinePayText')
                        </p>
                    </div>

                    <div class="card">
                        <img class="img img-fluid smart_phone" src="{{asset('tensendMobile.png')}}">
                    </div>
                </div>
                <div class="author d-lg-flex mt-4" id="about-section">
                    <div class="text">
                        <h3>@lang('messages.analyticsHead')</h3>
                        <p>@lang('messages.analyticsText')
                        </p>
                    </div>

                    <div class="card">
                        <img class="img img-fluid smart_phone" src="{{asset('tensendMobile.png')}}">
                    </div>
                </div>
                <div class="author d-lg-flex mt-4" id="about-section">
                    <div class="text">
                        <h3>@lang('messages.pushHead')</h3>
                        <p>@lang('messages.pushText')
                        </p>
                    </div>
                    <div class="card">
                        <img class="img img-fluid smart_phone" src="{{asset('tensendMobile.png')}}">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="site-section bg-light" id="testimonial-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="heading">@lang('messages.confidentiality')</h2>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <a target="_blank" href="{{asset('docs/Confidentiality.pdf')}}">@lang('messages.confidentialityPolitics')</a>
                </div>
            </div>
            {{--            <div class="row">--}}
            {{--                <div class="col-md-4">--}}
            {{--                    <div class="testimonial bg-white h-100">--}}
            {{--                        <blockquote class="mb-3">--}}
            {{--                            <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and--}}
            {{--                                Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at--}}
            {{--                                the coast of the Semantics, a large language ocean.&rdquo;</p>--}}
            {{--                        </blockquote>--}}
            {{--                        <div class="d-flex align-items-center vcard">--}}
            {{--                            <figure class="mb-0 mr-3">--}}
            {{--                                <img src="{{asset('front/images/person_3.jpg')}}"--}}
            {{--                                     alt="Free website template by Free-Template.co"--}}
            {{--                                     class="img-fluid rounded-circle">--}}
            {{--                            </figure>--}}
            {{--                            <div class="vcard-text">--}}
            {{--                                <span class="d-block">Jacob Spencer</span>--}}
            {{--                                <span class="position">Web Designer</span>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="col-md-4">--}}
            {{--                    <div class="testimonial bg-white h-100">--}}
            {{--                        <blockquote class="mb-3">--}}
            {{--                            <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and--}}
            {{--                                Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at--}}
            {{--                                the coast of the Semantics, a large language ocean.&rdquo;</p>--}}
            {{--                        </blockquote>--}}
            {{--                        <div class="d-flex align-items-center vcard">--}}
            {{--                            <figure class="mb-0 mr-3">--}}
            {{--                                <img src="{{asset('front/images/person_1.jpg')}}"--}}
            {{--                                     alt="Free website template by Free-Template.co"--}}
            {{--                                     class="img-fluid ounded-circle">--}}
            {{--                            </figure>--}}
            {{--                            <div class="vcard-text">--}}
            {{--                                <span class="d-block">David Shaun</span>--}}
            {{--                                <span class="position">Web Designer</span>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="col-md-4">--}}
            {{--                    <div class="testimonial bg-white h-100">--}}
            {{--                        <blockquote class="mb-3">--}}
            {{--                            <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and--}}
            {{--                                Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at--}}
            {{--                                the coast of the Semantics, a large language ocean.&rdquo;</p>--}}
            {{--                        </blockquote>--}}
            {{--                        <div class="d-flex align-items-center vcard">--}}
            {{--                            <figure class="mb-0 mr-3">--}}
            {{--                                <img src="{{asset('front/images/person_2.jpg')}}"--}}
            {{--                                     alt="Free website template by Free-Template.co"--}}
            {{--                                     class="img-fluid ounded-circle">--}}
            {{--                            </figure>--}}
            {{--                            <div class="vcard-text">--}}
            {{--                                <span class="d-block">Craig Smith</span>--}}
            {{--                                <span class="position">Web Designer</span>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </div>

    {{--    <div class="site-section py-5 bg-primary">--}}
    {{--        <div class="container">--}}
    {{--            <h3 class="text-white h4 mb-3 ml-3">Subscribe For The New Updates</h3>--}}
    {{--            <div class="d-flex">--}}
    {{--                <input type="text" class="form-control mr-4 px-4" placeholder="Enter your email address...">--}}
    {{--                <input type="submit" class="btn btn-white px-4" value="Send Email">--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <footer class="site-footer">
        <div class="container" id="contact-section">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="row mb-5">
                        <div class="col-12">
                            <h3 class="footer-heading mb-4">@lang('messages.aboutHead1')</h3>
                            <p>@lang('messages.aboutText1')<a href="">info@tensend.me</a>
                            </p>
                        </div>
                    </div>


                </div>
                <div class="col-lg-3 ml-auto">

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h3 class="footer-heading mb-4">@lang('messages.navigation')</h3>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#home-section">@lang('messages.mainPage')</a></li>
                                <li><a href="#features-section">@lang('messages.aboutPage')</a></li>
                                <li><a href="#testimonial-section">@lang('messages.politicPage')</a></li>
                                <li><a href="#contact-section">@lang('messages.contactPage')</a></li>
                            </ul>
                        </div>

                    </div>

                </div>


                {{--                <div class="col-lg-4 mb-5 mb-lg-0" id="contact-section">--}}

                {{--                    <div class="mb-5">--}}
                {{--                        <h3 class="footer-heading mb-4">Напишите нам</h3>--}}
                {{--                        <form method="post" class="form-subscribe">--}}
                {{--                            <div class="form-group mb-3">--}}
                {{--                                <input type="text" class="form-control border-white text-white bg-transparent"--}}
                {{--                                       placeholder="Имя" aria-label="Enter Email" aria-describedby="button-addon2">--}}
                {{--                            </div>--}}
                {{--                            <div class="form-group mb-3">--}}
                {{--                                <input type="text" class="form-control border-white text-white bg-transparent"--}}
                {{--                                       placeholder="Введите email" aria-label="Enter Email"--}}
                {{--                                       aria-describedby="button-addon2">--}}
                {{--                            </div>--}}
                {{--                            <div class="form-group mb-3">--}}
                {{--                                <textarea name="" class="form-control" id="" cols="30" rows="4"--}}
                {{--                                          placeholder="Сообщение"></textarea>--}}
                {{--                            </div>--}}
                {{--                            <div class="form-group">--}}
                {{--                                <button class="btn btn-primary px-5" type="submit">Отправить сообщение</button>--}}
                {{--                            </div>--}}
                {{--                        </form>--}}

                {{--                    </div>--}}
                {{--                    --}}
                {{--                </div>--}}

            </div>
            <div class="row pt-5 mt-5 text-center">
                <div class="col-md-12">
                    <div class="mb-4">
                        {{--<a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>--}}
                        {{--<a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>--}}
                        {{--<a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>--}}
                        {{--<a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>--}}
                    </div>
                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                        Все права защищены<i class="icon-heart text-danger"
                                             aria-hidden="true"></i> by <a
                            href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>

            </div>
        </div>
    </footer>
</div>

<script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('front/js/popper.min.js')}}"></script>
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('front/js/aos.js')}}"></script>
<script src="{{asset('front/js/jquery.sticky.js')}}"></script>
<script src="{{asset('front/js/stickyfill.min.js')}}"></script>
<script src="{{asset('front/js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('front/js/isotope.pkgd.min.js')}}"></script>

<script src="{{asset('front/js/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('front/js/main.js')}}"></script>
</body>
</html>
