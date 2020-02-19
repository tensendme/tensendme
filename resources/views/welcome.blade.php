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
                    <div class="col-6 col-lg-3">
                        <h1 class="my-0 site-logo"><a href="/">Tensend</a></h1>
                    </div>
                    <div class="col-6 col-lg-9">
                        <nav class="site-navigation text-right" role="navigation">
                            <div class="container">

                                <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3 "><a href="#"
                                                                                               class="site-menu-toggle js-menu-toggle text-black">
                                        <span class="icon-menu h3"></span>
                                    </a></div>

                                <ul class="site-menu main-menu js-clone-nav d-none d-lg-block">
                                    <li><a href="#home-section" class="nav-link">Негізгі бет</a></li>
                                    <li><a href="#features-section" class="nav-link">Tensend жайлы</a></li>
{{--                                    <li><a href="#about-section" class="nav-link">О нас</a></li>--}}
                                    <li><a href="#testimonial-section" class="nav-link">Құпиялық саясат</a></li>
                                    <li><a href="#contact-section" class="nav-link">Байланыс</a></li>
                                    <li>
                                        @auth
                                            <a href="{{ url('/home') }}" class="nav-link">Системаға кіру</a>
                                        @else
                                            <a href="{{ route('login') }}" class="nav-link">Кіру</a>
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
                <div class="col-md-6 mb-5">
                    <h1 class="text-white serif text-uppercase mb-4">Tensend Logo</h1>
                    <p class="text-white mb-5">Тренерлерге, мұғалімдерге, инфо-бизнесмендерге
                        мастер класс, семинар, онлайн курстарды өткізуге және
                        сатуға арналған мобильды қосымша
                    </p>
                    <p><a href="#" class="btn btn-white px-4 py-3">AppStore</a> <a href="#"
                                                                                   class="btn btn-white px-4 py-3">PlayMarket</a>
                    </p>
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
                    <h2 class="heading">Tensend жайлы</h2>
                    <p>Біз өзіміз әртүрлі салада онлайн курстарымызды
                        Tensend мобильды қосымшасы арқылы ай сайын 50 миллион теңгеден астам табыс
                        табамыз. Tensend мобильды қосымшасы ақша табуға мүмкіндік беретінін және
                        көмектесетінін біз жақсы білеміз.
                    </p>
                    <a href="{{asset('docs/Payment.pdf')}}">Политика платежных систем</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-book"></span>
              </span>
                        <h3>Білім беру</h3>
                        <p>Курстар, сабақтар, тапсырмаларыңызды
                            ыңғайлы және тез қоса аласыз.</p>
                    </div>

                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-bar-chart"></span>
              </span>
                        <h3>Статистика</h3>
                        <p>Сілтемемеңізбен өткен, орнатқан, сатып
                            алған адамдар жайлы және табысыңыз жайлы
                            толық ақпарат аласыз.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-attach_money"></span>
              </span>
                        <h3>Ақша шығару</h3>
                        <p>Мобильды қосымша арқылы табысыңызды
                            Тез және ыңғайлы түрде кез келген банк
                            картаңызға лезде шығара аласыз.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-first-order"></span>
              </span>
                        <h3>Ұтыс ойындар</h3>
                        <p>Tensend тарапынан барлық қолданушыларға
                            Керемет сыйлықтар, ұтыс ойындар өткізіледі.
                            Сіз курсыңызды жарнамалаған кезде осы ұтыстармен
                            Сыйлықтарды қолдана аласыз.</p>
                    </div>

                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-star"></span>
              </span>
                        <h3>Маркетинг</h3>
                        <p>Tensend тарапынан Сізге курсыңызды
                            жарнамалауға ыңғайлы болу үшін арнайы
                            Дайын Баннерлер мен жарнамалық
                            роликтерді қолдана аласыз.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-monetization_on"></span>
              </span>
                        <h3>Қосымша табыс</h3>
                        <p>Сіздің курсыңызды сәтті аяқтап берілген
                            Әр бір сертификатқа Сізге Tensend тарапынан
                            қосымша табыс төленеді.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="site-section bg-light" id="features-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-7">
                    <h2 class="heading">Өз әлеуетіңізді ашыңыз</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-attach_money"></span>
              </span>
                        <h3>Ақша табыңыз</h3>
                        <p>Оқушыларыңыздың әр жазылымынан түскен
                            ақшаны бір мезетте  карточкаңызға
                            аудара аласыз.</p>
                    </div>

                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-people_outline"></span>
              </span>
                        <h3>Оқушыларды шабыттандырыңыз</h3>
                        <p>Адамдарға жаңа дағдыларды үйренуге,
                            мансаптық өсуге және жаңа хоббилерді
                            табуға көмектесіңіз - біліміңізбен
                            бөлісіңіз.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-plus"></span>
              </span>
                        <h3>Біздің қоғамдастыққа қосылыңыз</h3>
                        <p>Курсты құруға көмектесу үшін біздің
                            белсенді инсрукторлар қоғамдастығына қосылыңыз.
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
                    <h2 class="heading">Сіздің жетістігіңіз өз қолыңызда</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-event_note"></span>
              </span>
                        <h3>Курсты жоспарлаңыз</h3>
                        <p>Іс-шаралар жоспарын дайындаңыз Ең бастысы,
                            сізде білім мен оны бөлісуге ниет бар. Олай болса,
                            тақырыпты таңдап, Google Docs, Microsoft Excel
                            бағдарламаларында дәріс жоспарын жасаңыз немесе
                            блокнотқа қолмен кесте сызыңыз. Сіздің бағытыңыз
                            сізге қалай байланысты болады. Мүмкіндігінше көп
                            студенттерді шабыттандыру үшін оны бірнеше тілде дайындауға
                            болады. Көмек керек пе? Tensend-те сіз өзіңіздің жеке
                            курстарыңызды құруға арналған тегін тренингке қатыса аласыз,
                            онда сіз нақты өмірден мысалдарды үйреніп, алған білімдеріңізді
                            практикада шоғырландырасыз. Сонымен қатар,
                            бұл жұмыста мұғалімнің панелі мен оқу парағы көмектеседі.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-camera"></span>
              </span>
                        <h3>Бейне жазыңыз</h3>
                        <p>Бейнелеріңіздің режиссері болыңыз
                            Сізде смартфон немесе SLR камерасы бар ма?
                            Оларға сыртқы микрофонды қосу жеткілікті,
                            және сіз бірінші дәрісті үйде немесе қай жерде
                            болсаңыз да жазуды бастай аласыз. Камерадан ұялып,
                            кадрда болғыңыз келмей ме? Содан кейін сценарий жазу
                            бағдарламасын қолданыңыз (мысалы, Камтасия) және слайдтар
                            мен экрандағы түсініктемелері бар дәріс дайындаңыз.
                            Көмек керек пе? Біздің қолдау тобымыз әрқашан сіздің
                            бейнелеріңізді тексеруге және көмектесуге дайын.
                            Біздің интернеттегі мұғалімдер қауымдастығында сіз әрдайым
                            әріптестердің пікірлерін біліп, жаңа шабыт көздерін таба аласыз.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-camera_front"></span>
              </span>
                        <h3>Курсыңызды жарнамалаңыз</h3>
                        <p>Жеке кабинетіңізде маркетинг
                            бөлімінде Сіздің курсыңыздын жарнамасына арналған дайын роликтерді, баннерлерді қолданыңыз.
                            Өз жеке сілтемеңізбен курсыңызды кез келген әлеуметтік
                            желіде немесе интернет сайттарда
                            жарнамалау арқылы табысыңызды көбейтіңіз
                            Көмек керек пе?
                            Tensend-тің әлеуметтік желілерде жарнамаға арналған
                            тегін курстарын қарап шығып практика жүзінде қолданыңыз.
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
                    <h2 class="heading">Білім беру</h2>
                </div>
                <div class="author  d-lg-flex" id="about-section">
                    <div class="bg-img" style="background-image: url('{{asset('front/images/author_1.jpg')}}');"></div>
                    <div class="text">
                        <h3>Курсыңыздың сабақтары</h3>
                        <p>Сіз өз жеке курсыңыздың сабақтарын қосымшаға
                            Қосу арқылы әр сабағыңыздын соңында
                            Қосымша презентация, чек-лист, немесе тапсырмаларды
                            Жүктей аласыз.
                        </p>
                    </div>
                </div>
                <div class="author d-lg-flex mt-4" id="about-section">
                    <div class="bg-img" style="background-image: url('{{asset('front/images/author_1.jpg')}}');"></div>
                    <div class="text">
                        <h3>Курсыңыздың сабақтарына доступ беру</h3>
                        <p>Курсыңыздың алғашқы 1-2 сабағы ғана ашылып қалған сабақтарыңыз
                            тек «подписка» жасаған соң ғана ашылады.
                        </p>
                    </div>
                </div>
                <div class="author d-lg-flex mt-4" id="about-section">
                    <div class="bg-img" style="background-image: url('{{asset('front/images/author_1.jpg')}}');"></div>
                    <div class="text">
                        <h3>Автоматтадырылған сертификат беру процессі</h3>
                        <p>Әр курсыңызды сәтті аяқтаған оқушыңыз курстың соңында бір минутта дайын
                            электрондық сертификаттын ала алады. Әр берілген сертификат үшін Сіз Tensend
                            Тарапынан курсыңыздын құндылығы үшін қосымша табыс аласыз.
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
                        Жүйелендірілген сатылым және CRM</h2>
                <p>Біз өзіміз әртүрлі салада онлайн курстарымызды
                    Tensend мобильды қосымшасы арқылы ай сайын 50 миллион теңгеден астам табыс
                    табамыз. Tensend мобильды қосымшасы ақша табуға мүмкіндік беретінін және
                    көмектесетінін біз жақсы білеміз.
                </p>
            </div>
    <div class="author  d-lg-flex" id="about-section">
        <div class="text">
            <h3>Төлемдерді онлайн қабылдау</h3>
            <p>Кез келген банктін картасымен Tensend-тің
                ішінде клиентіңіз төлем жасай алады. Төлем жасағаннан соң
                барлық курстарға автоматты түрде “доступ” ашылады.
            </p>
        </div>
        <div class="bg-img" style="background-image: url('{{asset('front/images/author_1.jpg')}}');"></div>
    </div>
    <div class="author d-lg-flex mt-4" id="about-section">
        <div class="text">
            <h3>Аналитика</h3>
            <p>Сіз кез келген уақытта сіздің сілтемемеңізбен қанша қолданушы өткенін,
                қаншасы қосымшаны орнатқаны, қаншасы сатып алғаны  жайлы және
                сіздің табысыңыз жайлы толық ақпарат аласыз.
            </p>
        </div>
        <div class="bg-img" style="background-image: url('{{asset('front/images/author_1.jpg')}}');"></div>
    </div>
    <div class="author d-lg-flex mt-4" id="about-section">
        <div class="text">
            <h3>SMS, PUSH хабарландырулар</h3>
            <p>Енді Сізге сату бөлімін құру, қосымша адамдарды жұмысқа алып,
                SMS, CRM интеграциясын жасап шығындалудың қажеті жоқ. Tensend-те
                Барлығы Сіз үшін ойластырылған және Сіз үшін тегін. Сіздің сілтемеңізбен
                өтіп қосымшаны орнатқан бырақ әлі жазылмаған барлық қолданушыға
                Tensend sms және push хабарламаларды жіберіп Сіздің табысыңызды көтереді.
            </p>
        </div>
        <div class="bg-img" style="background-image: url('{{asset('front/images/author_1.jpg')}}');"></div>
    </div>
        </div>
    </div>
    </div>



    <div class="site-section bg-light" id="testimonial-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="heading">Конфиденциальность</h2>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <a target="_blank" href="{{asset('docs/Confidentiality.pdf')}}">Политика конфиденциальности</a>
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
                            <h3 class="footer-heading mb-4">Tensend жайлы</h3>
                            <p>Біз өзіміз әртүрлі салада онлайн курстарымызды
                                Tensend мобильды қосымшасы
                                арқылы ай сайын 50 миллион теңгеден астам табыс табамыз.
                                Tensend мобильды қосымшасы ақша табуға мүмкіндік беретінін
                                және көмектесетінін біз жақсы білеміз.</p>
                        </div>
                    </div>


                </div>
                <div class="col-lg-3 ml-auto">

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h3 class="footer-heading mb-4">Навигация</h3>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#home-section">Негізгі бет</a></li>
                                <li><a href="#features-section">Tensend жайлы</a></li>
                                <li><a href="#testimonial-section">Құпиялық саясат</a></li>
                                <li><a href="#contact-section">Байланыс</a></li>
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
