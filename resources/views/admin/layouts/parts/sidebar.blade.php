<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
            <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                <div class="d-table m-auto">
                    <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;"
                         src="{{asset('tensend.png')}}" alt="Shards Dashboard">
                    <span class="d-none d-md-inline ml-1">TenSendMe</span>
                </div>
            </a>
            <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
            </a>
        </nav>
    </div>
    {{--    <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">--}}
    {{--        <div class="input-group input-group-seamless ml-3">--}}
    {{--            <div class="input-group-prepend">--}}
    {{--                <div class="input-group-text">--}}
    {{--                    <i class="fas fa-search"></i>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>--}}
    {{--    </form>--}}
    <div class="nav-wrapper">
        <ul class="nav flex-column">
            @if(in_array(Auth::user()->role_id ,[1,2,3,6,4]) )
                <li class="nav-item">
                    <a class="nav-link {{Helper::urlActiveHelper('home')}}"
                       href="{{route('home')}}">
                        <i class="material-icons">edit</i>
                        <span>Главное</span>
                    </a>
                </li>
            @endif
            @if(in_array(Auth::user()->role_id ,[1,2,3,6]) )
                <li class="nav-item">
                    <a class="nav-link {{Helper::urlActiveHelper('users')}}"
                       href="{{route('users.index')}}">
                        <i class="material-icons">face</i>
                        <span>Пользователи</span>
                    </a>
                </li>
            @endif
            @if(in_array(Auth::user()->role_id ,[1,2,3,4]) )
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" type="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">perm_media</i>
                            <span>Медиа</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{route('course.index')}}"
                               class="nav-link dropdown-item {{Helper::urlActiveHelper('course')}}">
                                <i class=" material-icons">book</i>
                                <span>Курсы</span>
                            </a>
                            @if(Auth::user()->role_id != 4)
                                <a href="{{route('meditation.index')}}"
                                   class="nav-link dropdown-item {{Helper::urlActiveHelper('meditation')}}">
                                    <i class=" material-icons">library_music</i>
                                    <span>Медитация</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </li>
            @endif
            @if(in_array(Auth::user()->role_id ,[1,2,3]) )
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" type="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">camera_alt</i>
                            <span>Реклама</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{route('location.index')}}"
                               class="nav-link dropdown-item {{Helper::urlActiveHelper('location')}}">
                                <i class=" material-icons">mobile_screen_share</i>
                                <span>Локации</span>
                            </a>
                            <a class="nav-link dropdown-item  {{Helper::urlActiveHelper('news')}}"
                               href="{{route('news.index')}}">
                                <i class="material-icons">local_play</i>
                                <span>Новости</span>
                            </a>
                            <a class="nav-link dropdown-item  {{Helper::urlActiveHelper('banner')}}"
                               href="{{route('banner.index')}}">
                                <i class="material-icons">flag</i>
                                <span>Банера</span>
                            </a>
                        </div>
                    </div>
                </li>
            @endif
            @if(in_array(Auth::user()->role_id ,[1,2,3,6]) )
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" type="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">accessibility</i>
                            <span>Действия пользователей</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="nav-link  {{Helper::urlActiveHelper('subscription')}}"
                               href="{{route('subscription.index')}}">
                                <i class="material-icons">people</i>
                                <span>Подписки на приложение</span>
                            </a>
                            <a class="nav-link  {{Helper::urlActiveHelper('follower')}}"
                               href="{{route('follower.index')}}">
                                <i class="material-icons">assignment</i>
                                <span>Подписчики</span>
                            </a>
                            <a href="{{route('withdrawal.index')}}"
                               class="nav-link dropdown-item {{Helper::urlActiveHelper('withdrawal')}}">
                                <i class=" material-icons">monetization_on</i>
                                <span>Запросы</span>
                            </a>
                            <a href="{{route('transaction.index')}}"
                               class="nav-link dropdown-item {{Helper::urlActiveHelper('transaction')}}">
                                <i class=" material-icons">account_balance_wallet</i>
                                <span>Транзакции</span>
                            </a>
                            <a href="{{route('history.index')}}"
                               class="nav-link dropdown-item {{Helper::urlActiveHelper('history')}}">
                                <i class=" material-icons">history</i>
                                <span>Истории</span>
                            </a>
                        </div>
                    </div>
                </li>
            @endif

            @if(in_array(Auth::user()->role_id ,[1]) )
                <li class="nav-item">
                    <a class="nav-link {{Helper::urlActiveHelper('notification.index')}}"
                       href="{{route('notification.index')}}">
                        <i class="material-icons">message</i>
                        <span>Уведомления</span>
                    </a>
                </li>
            @endif
            @if(in_array(Auth::user()->role_id ,[1,2,3]) )
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" type="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">settings_applications</i>
                            <span>Настройки</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="nav-link dropdown-item  {{Helper::urlActiveHelper('category')}}"
                               href="{{route('category.index')}}">
                                <i class="material-icons">vertical_split</i>
                                <span>Категории</span>
                            </a>
                            <a class="nav-link dropdown-item  {{Helper::urlActiveHelper('level')}}"
                               href="{{route('level.index')}}">
                                <i class="material-icons">filter_list
                                </i>
                                <span>Уровни</span>
                            </a>
                            <a class="nav-link dropdown-item  {{Helper::urlActiveHelper('country')}}"
                               href="{{route('country.index')}}">
                                <i class="material-icons">business</i>
                                <span>Страны</span>
                            </a>
                            <a class="nav-link dropdown-item  {{Helper::urlActiveHelper('city')}}"
                               href="{{route('city.index')}}">
                                <i class="material-icons">home_work</i>
                                <span>Города</span>
                            </a>
                            <a class="nav-link dropdown-item  {{Helper::urlActiveHelper('subscription.type.index')}}"
                               href="{{route('subscription.type.index')}}">
                                <i class="material-icons">playlist_add_check</i>
                                <span>Типы подписок</span>
                            </a>
                            <a class="nav-link dropdown-item  {{Helper::urlActiveHelper('faq.index')}}"
                               href="{{route('faq.index')}}">
                                <i class="material-icons">question_answer</i>
                                <span>FAQ</span>
                            </a>
                            <a class="nav-link dropdown-item  {{Helper::urlActiveHelper('marketingMaterial.index')}}"
                               href="{{route('marketingMaterial.index')}}">
                                <i class="material-icons">attach_file</i>
                                <span>Marketing материалы</span>
                            </a>

                            <a class="nav-link dropdown-item  {{Helper::urlActiveHelper('setting.index')}}"
                               href="{{route('setting.index')}}">
                                <i class="material-icons">info</i>
                                <span>Про нас</span>
                            </a>
                        </div>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</aside>
