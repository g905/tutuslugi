<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fontfaces CSS-->
    <link href="/backend/css/font-face.css" rel="stylesheet" media="all">
    <link href="/backend/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="/backend/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">


    <!-- Bootstrap CSS-->
    <link href="/backend/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="/backend/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="/backend/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="/backend/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="/backend/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="/backend/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="/backend/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="/backend/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">


    <!-- Main CSS-->
    <link href="/backend/css/theme.css" rel="stylesheet" media="all">


</head>
<body>

<div class="page-wrapper">
    <!-- HEADER MOBILE-->
    <header class="header-mobile d-block d-lg-none">
        <div class="header-mobile__bar">
            <div class="container-fluid">
                <div class="header-mobile-inner">
                    <a class="logo" href="/pult">

                    </a>
                    <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                    </button>
                </div>
            </div>
        </div>
        <nav class="navbar-mobile">
            <div class="container-fluid">
                <ul class="navbar-mobile__list list-unstyled">


                </ul>
            </div>
        </nav>
    </header>
    <!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="logo">
            <a href="/pult">
                <img src="/images/logo_min.svg" alt="Din1sCMS"/>
            </a>
        </div>

        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar2 navbar-sidebar3">
                <ul class="list-unstyled navbar__list">
                    <li class="@if(Route::current()->getName() == 'admin.items.list') active @endif"><a href="{{route('admin.items.list')}}/"><i class="fa fa-list"></i> Услуги</a></li>
                    <li class="@if(Route::current()->getName() == 'admin.category.list') active @endif"><a href="{{route('admin.category.list')}}/"><i class="fa fa-sitemap"></i> Категории</a></li>
                    <li class="@if(Route::current()->getName() == 'admin.seopages.list') active @endif"><a href="{{route('admin.seopages.list')}}/"><i class="fa fa-rocket"></i> Подборки</a></li>
                    <li class="@if(Route::current()->getName() == 'admin.region.list') active @endif"><a href="{{route('admin.region.list')}}/"><i class="fa fa-map-marker"></i> Регионы</a></li>
                    <li class="@if(Route::current()->getName() == 'admin.users.list') active @endif"><a href="{{route('admin.users.list')}}/"><i class="fa fa-users"></i> Пользователи</a></li>
                    <li class="@if(Route::current()->getName() == 'admin.seo.edit') active @endif"><a href="{{route('admin.seo.edit')}}/"><i class="fa fa-fighter-jet"></i> Настройки сайта</a></li>
                    {{--<li class=""><a href="{{route('admin.pages.list')}}"><i class="fa fa-file-text"></i> Страницы</a></li>
                    <li class=""><a href=""><i class="fa fa-envelope"></i> Работа с почтой</a></li>--}}
                    <li class="@if(Route::current()->getName() == 'admin.items.import') active @endif"><a href="{{route('admin.items.import')}}/"><i class="fa fa-upload" aria-hidden="true"></i>Импорт объявлений</a></li>
                    <li class=""><a href="{{route('admin.contacts.list')}}/"><i class="fa fa-exclamation-triangle"></i>  Обратная связь</a></li>
                    <li class=""><a href="{{route('admin.contacts-adverts.list')}}/"><i class="fa fa-comments"></i>  Сообщения</a></li>
{{--
                    <li class=""><a href="{{route('admin.downloads.list')}}"><i class="fa fa-cog"></i> Настройки</a></li>
--}}
{{--
                    <li class=""><a href="{{route('admin.downloads.list')}}"><i class="fa fa-download"></i> Загрузки</a></li>
--}}


                </ul>
            </nav>
        </div>
    </aside>
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap">
                        <form class="form-header" action="" method="POST">

                        </form>
                        <div class="header-button">

                            <div class="account-wrap">
                                <div class="account-item clearfix js-item-menu">
                                    <div class="image">

                                    </div>
                                    <div class="content">
                                        <a class="js-acc-btn" href="#">Администратор</a>
                                    </div>
                                    <div class="account-dropdown js-dropdown">
                                        <div class="info clearfix">
                                            <div class="image">

                                            </div>
                                            <div class="content">
                                                <h5 class="name">
                                                    <a href="#">{{Auth::user()->fio}}</a>
                                                </h5>
                                                <span class="email">{{Auth::user()->email}}</span>
                                            </div>
                                        </div>
                                       {{-- <div class="account-dropdown__body">
                                            <div class="account-dropdown__item">
                                                <a href="/account">
                                                    <i class="zmdi zmdi-account"></i>Аккаунт</a>
                                            </div>


                                        </div>--}}
                                        <div class="account-dropdown__footer">
                                            <a href="{{route('user.logout')}}">
                                                <i class="zmdi zmdi-power"></i>Выйти</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        {!! \Session::get('success') !!}
                    </div>
                @endif
                    @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        {!! \Session::get('error') !!}
                    </div>
                @endif

                    @yield('content')


            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>

<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itemModalLabel">Информация об объявлении t-2263565226</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-item-title">Очистка канализации методом продува и накачки и еще что-то</div>
                <div class="modal-item-text">Выполняем отделочные работы любой сложности, цена договорная.
                    Специализируемся в основном на штукатурных и малярных работах. Имеется своя механизация и инструменты.
                    Посредникам просьба, не звонить!</div>

                <div class="modal-item-title-small">Примеры работ</div>
                <div class="modal-item-example-work">


                </div>

                <div class="modal-item-title-small">Услуги и цены</div>

                <div class="section__items-item-prices modal-item-price">




                </div>

            </div>
            <div class="modal-footer">
                <div class="modal-item-info">

                    <div><small>Самара · Транспорт и перевозки · Спецтехника</small></div>
                    <div class="modal-item-info-1">Пользователь: <a href="">md5020@yandex.ru</a></div>
                    <div class="modal-item-info-2">Статус: Заблокировано  (Сегодня 14:07)</div>
                    <div class="modal-item-info-3">Период публикации: 04.01.2018 - 26.11.2021</div>
                    <div class="buttons-inner modal-item-info-4">

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Jquery JS-->
<script src="/backend/vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="/backend/vendor/bootstrap-4.1/popper.min.js"></script>
<script src="/backend/vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="/backend/vendor/slick/slick.min.js">
</script>
<script src="/backend/vendor/wow/wow.min.js"></script>
<script src="/backend/vendor/animsition/animsition.min.js"></script>
<script src="/backend/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="/backend/vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="/backend/vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="/backend/vendor/circle-progress/circle-progress.min.js"></script>
<script src="/backend/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/backend/vendor/chartjs/Chart.bundle.min.js"></script>
<script src="/backend/vendor/select2/select2.min.js">
</script>
<script src="/backend/js/jquery.maskedinput.js"></script>
<!-- Main JS-->
<script src="/backend/js/main.js"></script>
</body>
</html>
