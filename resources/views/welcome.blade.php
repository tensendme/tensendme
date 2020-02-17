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
                                    <li><a href="#home-section" class="nav-link">Главная</a></li>
                                    <li><a href="#features-section" class="nav-link">Особенности</a></li>
                                    <li><a href="#about-section" class="nav-link">О нас</a></li>
                                    <li><a href="#testimonial-section" class="nav-link">Конфиденциальность</a></li>
                                    <li><a href="#contact-section" class="nav-link">Контакты</a></li>
                                    <li>
                                        @auth
                                            <a href="{{ url('/home') }}" class="nav-link">В систему</a>
                                        @else
                                            <a href="{{ route('login') }}" class="nav-link">Войти</a>
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
                    <h1 class="text-white serif text-uppercase mb-4">Ваш помощник в развитии</h1>
                    <p class="text-white mb-5">У нас собраны все важные курсы для вашего развития</p>
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
                    <h2 class="heading">Особенности</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, harum repudiandae provident neque
                        voluptas odio nostrum officiis debitis et vitae, dolorem placeat fugiat recusandae aperiam
                        aspernatur expedita alias, officia. Suscipit!</p>
                    <a href="{{asset('docs/Payment.pdf')}}">Политика платежных систем</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-book"></span>
              </span>
                        <h3>Hard Cover</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic tenetur ea in accusantium
                            est.</p>
                    </div>

                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-bank"></span>
              </span>
                        <h3>Онлайн оплата</h3>
                        <p>Оплата Visa, Mastercard</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-settings_backup_restore"></span>
              </span>
                        <h3>Возврат денег</h3>
                        <p>При проведении онлайн-оплаты посредством платежных карт не допускается возврат
                            наличными денежными средствами. Порядок возврата регулируется правилами
                            международных платежных систем</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-font"></span>
              </span>
                        <h3>Big Text</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic tenetur ea in accusantium
                            est.</p>
                    </div>

                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-photo"></span>
              </span>
                        <h3>Images</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic tenetur ea in accusantium
                            est.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
              <span class="wrap-icon">
                <span class="icon-text-height"></span>
              </span>
                        <h3>Readable Text</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic tenetur ea in accusantium
                            est.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-7">
                    <h2 class="heading">Скриншоты</h2>
                    <p>Эти виды вы можете увидеть используя Tensend</p>
                    <p class="mb-3">
                        <a href="#" class="customNextBtn">Предыдущий</a>
                        <span class="mx-2">/</span>
                        <a href="#" class="customPrevBtn">Следующий</a>
                    </p>
                </div>
            </div>

            <div class="owl-carousel slide-one-item">
                <img src="{{asset('front/images/img_1.jpg')}}" alt="Image" class="img-fluid">
                <img src="{{asset('front/images/img_2.jpg')}}" alt="Image" class="img-fluid">
                <img src="{{asset('front/images/img_3.jpg')}}" alt="Image" class="img-fluid">
                <img src="{{asset('front/images/img_4.jpg')}}" alt="Image" class="img-fluid">
                <img src="{{asset('front/images/img_5.jpg')}}" alt="Image" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="author  d-lg-flex" id="about-section">
        <div class="bg-img" style="background-image: url('{{asset('front/images/author_1.jpg')}}');"></div>
        <div class="text">
            <h3>Hello It's Jane</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis qui voluptates illum harum minima
                accusantium praesentium eos aut ab. Voluptate nulla illum ullam maxime consequuntur labore qui delectus,
                omnis saepe.</p>
            <p>Eos ratione repellat ea dignissimos iure ipsam sed dolore, excepturi id recusandae cumque sit, fugiat
                obcaecati necessitatibus nisi voluptate similique? Sed quae itaque nisi magnam amet aut maiores debitis
                temporibus.</p>
            <p>Iste repellendus libero cumque facilis sint quas quis temporibus quia veritatis reiciendis obcaecati,
                magni, dolorum aspernatur laborum, est, sequi rerum! Perspiciatis facilis commodi libero ipsa minima
                reiciendis rerum, facere quaerat.</p>

            div.social_

            <div class="mt-5">
                <span class="d-block text-black mb-4">Jane Smith, <span
                            class="text-muted">Book Author &amp; Publisher</span></span>
                <img src="{{asset('front/images/signature.png')}}" alt="Image" class="img-fluid w-25">
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
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial bg-white h-100">
                        <blockquote class="mb-3">
                            <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and
                                Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at
                                the coast of the Semantics, a large language ocean.&rdquo;</p>
                        </blockquote>
                        <div class="d-flex align-items-center vcard">
                            <figure class="mb-0 mr-3">
                                <img src="{{asset('front/images/person_3.jpg')}}"
                                     alt="Free website template by Free-Template.co"
                                     class="img-fluid rounded-circle">
                            </figure>
                            <div class="vcard-text">
                                <span class="d-block">Jacob Spencer</span>
                                <span class="position">Web Designer</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial bg-white h-100">
                        <blockquote class="mb-3">
                            <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and
                                Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at
                                the coast of the Semantics, a large language ocean.&rdquo;</p>
                        </blockquote>
                        <div class="d-flex align-items-center vcard">
                            <figure class="mb-0 mr-3">
                                <img src="{{asset('front/images/person_1.jpg')}}"
                                     alt="Free website template by Free-Template.co"
                                     class="img-fluid ounded-circle">
                            </figure>
                            <div class="vcard-text">
                                <span class="d-block">David Shaun</span>
                                <span class="position">Web Designer</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial bg-white h-100">
                        <blockquote class="mb-3">
                            <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and
                                Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at
                                the coast of the Semantics, a large language ocean.&rdquo;</p>
                        </blockquote>
                        <div class="d-flex align-items-center vcard">
                            <figure class="mb-0 mr-3">
                                <img src="{{asset('front/images/person_2.jpg')}}"
                                     alt="Free website template by Free-Template.co"
                                     class="img-fluid ounded-circle">
                            </figure>
                            <div class="vcard-text">
                                <span class="d-block">Craig Smith</span>
                                <span class="position">Web Designer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section py-5 bg-primary">
        <div class="container">
            <h3 class="text-white h4 mb-3 ml-3">Subscribe For The New Updates</h3>
            <div class="d-flex">
                <input type="text" class="form-control mr-4 px-4" placeholder="Enter your email address...">
                <input type="submit" class="btn btn-white px-4" value="Send Email">
            </div>
        </div>
    </div>

    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="row mb-5">
                        <div class="col-12">
                            <h3 class="footer-heading mb-4">О нас</h3>
                            <p>Первая система в Казахстане концентрирующая внимание на развитии и
                                эмоциональном спокойствии</p>
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
                                <li><a href="#">Главная</a></li>
                                <li><a href="#">Особенности</a></li>
                                <li><a href="#">О нас</a></li>
                                <li><a href="#">Конфиденциальность</a></li>
                                <li><a href="#">Контакты</a></li>
                            </ul>
                        </div>

                    </div>

                </div>


                <div class="col-lg-4 mb-5 mb-lg-0" id="contact-section">

                    <div class="mb-5">
                        <h3 class="footer-heading mb-4">Напишите нам</h3>
                        <form method="post" class="form-subscribe">
                            <div class="form-group mb-3">
                                <input type="text" class="form-control border-white text-white bg-transparent"
                                       placeholder="Имя" aria-label="Enter Email" aria-describedby="button-addon2">
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control border-white text-white bg-transparent"
                                       placeholder="Введите email" aria-label="Enter Email"
                                       aria-describedby="button-addon2">
                            </div>
                            <div class="form-group mb-3">
                                <textarea name="" class="form-control" id="" cols="30" rows="4"
                                          placeholder="Сообщение"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary px-5" type="submit">Отправить сообщение</button>
                            </div>
                        </form>

                    </div>


                </div>

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