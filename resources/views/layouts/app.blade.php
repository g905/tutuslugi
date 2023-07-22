<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow"/>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">



    <link rel="canonical" href="{{ url()->current() }}/"/>

    @if(Route::current()->getName() == 'advert.current' OR (!empty($DisableSearchBots) && $DisableSearchBots==1))
        <meta name="robots" content="noindex, nofollow"/>
    @endif

    @if(!empty($dataPageDefault))
        @if(!empty($dataPageDefault->title))<title>{{ $dataPageDefault->title }}</title>@endif

        @if(!empty($dataPageDefault->description))
            <meta name="description" content="{{ $dataPageDefault->description }}">@endif

        @if(!empty($dataPageDefault->keywords))
            <meta name="keywords" content="{{ $dataPageDefault->keywords }}">@endif

    @else
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="keywords" content="">
        <meta name="description" content="">
@endif

<!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-M29CMSG');</script>
    <!-- End Google Tag Manager -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}?v={{$Version}}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/swiper.js') }}?v={{$Version}}"></script>
    <script src="{{ asset('js/app.js') }}?v={{$Version}}"></script>


</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M29CMSG"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="app" class="@if(!empty($hideHeaderItems) && $hideHeaderItems==1) full-bg-gray @endif">

    @if(!empty($HeaderNotification->text))
        <div class="header-notification">
            <div class="container">
                @if(!empty($HeaderNotification->description)) <a href="{{$HeaderNotification->description}}"> @endif
                    {{$HeaderNotification->text}}

                    @if(!empty($HeaderNotification->description)) </a> @endif
            </div>
        </div>
    @endif

    <header>
        <div class="container">
            <div class="header__inner">
                <div class="header__logo d-md-block">
                    <a href="@if(!empty($CityRegion)) /{{$CityRegion->url}}/ @else / @endif"><img
                            src="/images/logo.svg"/></a>
                </div>
                @if(empty($hideHeaderItems) || $hideHeaderItems!=1)
                <div class="header_menu">
                    <a href="#">
                        <i class="svg-ui-icon">
                            <svg width="18" height="14" viewBox="0 0 18 14" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1H17H1ZM1 7H17H1ZM1 13H8H1Z" fill="white"/>
                                <path d="M1 13H8M1 1H17H1ZM1 7H17H1Z" stroke="white" stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </i>
                    </a>
                </div>

                <div class="header__location__selector">
                    <a href="/region/" class="header__location_selector_text">
                        <i class="svg-ui-icon">
                            <svg width="14" height="18" viewBox="0 0 14 18" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M6.69 16.933L6.693 16.934C6.89 17.02 7 17 7 17C7 17 7.11 17.02 7.308 16.934L7.31 16.933L7.316 16.93L7.334 16.922C7.42893 16.8779 7.52263 16.8312 7.615 16.782C7.801 16.686 8.061 16.542 8.372 16.349C8.992 15.965 9.817 15.383 10.646 14.584C12.302 12.988 14 10.493 14 7C14 6.08075 13.8189 5.1705 13.4672 4.32122C13.1154 3.47194 12.5998 2.70026 11.9497 2.05025C11.2997 1.40024 10.5281 0.884626 9.67878 0.532843C8.8295 0.18106 7.91925 0 7 0C6.08075 0 5.1705 0.18106 4.32122 0.532843C3.47194 0.884626 2.70026 1.40024 2.05025 2.05025C1.40024 2.70026 0.884626 3.47194 0.532843 4.32122C0.18106 5.1705 -1.36979e-08 6.08075 0 7C0 10.492 1.698 12.988 3.355 14.584C4.04875 15.2503 4.8106 15.8419 5.628 16.349C5.94459 16.5456 6.27029 16.7271 6.604 16.893L6.666 16.922L6.684 16.93L6.69 16.933ZM7 9.25C7.59674 9.25 8.16903 9.01295 8.59099 8.59099C9.01295 8.16903 9.25 7.59674 9.25 7C9.25 6.40326 9.01295 5.83097 8.59099 5.40901C8.16903 4.98705 7.59674 4.75 7 4.75C6.40326 4.75 5.83097 4.98705 5.40901 5.40901C4.98705 5.83097 4.75 6.40326 4.75 7C4.75 7.59674 4.98705 8.16903 5.40901 8.59099C5.83097 9.01295 6.40326 9.25 7 9.25Z"
                                      fill="#8695BD"/>
                            </svg>
                        </i> {{$CityRegionDefault->name}}</a>
                </div>


                <div class="header__wishlist">
                    <a href="{{route('wishlist')}}/" class="header__wishlist_text">
                        <i class="svg-ui-icon">
                            <svg width="16" height="14" viewBox="0 0 16 14" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.653 13.9149L7.648 13.9119L7.629 13.9019C7.23439 13.6872 6.84685 13.4598 6.467 13.2199C5.56136 12.6501 4.69842 12.0151 3.885 11.3199C2.045 9.73294 0 7.35194 0 4.49994C8.83184e-05 3.5694 0.288649 2.66177 0.82595 1.90203C1.36325 1.14229 2.12287 0.567793 3.0002 0.257655C3.87754 -0.0524833 4.82944 -0.0830133 5.72485 0.170269C6.62025 0.42355 7.41512 0.948187 8 1.67194C8.58488 0.948187 9.37975 0.42355 10.2752 0.170269C11.1706 -0.0830133 12.1225 -0.0524833 12.9998 0.257655C13.8771 0.567793 14.6367 1.14229 15.174 1.90203C15.7114 2.66177 15.9999 3.5694 16 4.49994C16 7.35194 13.956 9.73294 12.115 11.3199C10.9593 12.3074 9.70467 13.1726 8.371 13.9019L8.352 13.9119L8.347 13.9149H8.345C8.23875 13.9712 8.12037 14.0007 8.00012 14.0009C7.87988 14.0011 7.76142 13.9719 7.655 13.9159L7.653 13.9149Z"
                                    fill="#8695BD"/>
                            </svg>
                        </i> Избранное</a>
                </div>

                <div class="header__user guest">
                    <a href="@guest{{route('user.login')}}/@else{{route('user.profile')}}/@endguest"
                       class="header__user_text">
                        <i class="svg-ui-icon">
                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.00002 6C7.79567 6 8.55873 5.68393 9.12134 5.12132C9.68395 4.55871 10 3.79565 10 3C10 2.20435 9.68395 1.44129 9.12134 0.87868C8.55873 0.316071 7.79567 0 7.00002 0C6.20437 0 5.4413 0.316071 4.8787 0.87868C4.31609 1.44129 4.00002 2.20435 4.00002 3C4.00002 3.79565 4.31609 4.55871 4.8787 5.12132C5.4413 5.68393 6.20437 6 7.00002 6ZM0.465016 12.493C0.372181 12.7411 0.361939 13.0126 0.435813 13.267C0.509687 13.5214 0.663728 13.7452 0.875016 13.905C2.62635 15.266 4.782 16.0034 7.00002 16C9.31002 16 11.438 15.216 13.131 13.9C13.561 13.567 13.735 12.997 13.539 12.49C13.0313 11.168 12.1346 10.0311 10.9673 9.22922C9.80008 8.42737 8.41712 7.99829 7.00098 7.99861C5.58485 7.99894 4.20209 8.42865 3.03521 9.23104C1.86833 10.0334 0.972174 11.1708 0.465016 12.493Z"
                                    fill="#7D2AEB"/>
                            </svg>
                        </i> Личный кабинет</a>
                </div>

                    @endif
            </div>
        </div>
    </header>

        <section class="content-top">
        @yield('content-top')
        </section>
<div class="app-inner">
    <main>


       {{-- @include("notifications.error",['Title'=>"1111",'Text'=>"2222"])--}}
        @if (session('success'))
            @include("notifications.success",['Title'=>session('success'),'Text'=>session('success_text')])

           {{-- <div class="alert alert-success alert-top-right" role="alert">
                <div class="alert-title">{{ session('success') }}</div>
            </div>--}}
            @php
                Session::forget('success');
                Session::forget('success_text');
            @endphp
        @endif

        @yield('content')
    </main>


    @if(!empty($SeoBottomCategories))
        <div class="seo-bottom-city-list seo-bottom-city-list-categorys">
            <div class="container">
                <div class="container-inner">


                    @if(!empty($SeoBottomCategories))
                        @foreach($SeoBottomCategories as $Category)
                            <div class="seo-bottom-city-list__list__items-col">
                                @foreach($Category as $category)
                                    <div class="seo-bottom-city-list__list__items-item">
                                        <a href="/{{$CityRegion->url}}/@if(!empty($category->parent_url)){{$category->parent_url['slug']}}/@endif{{$category->url}}/">{{$category->name}}</a>

                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    @endif


    <footer>
        <div class="container">
            <div class="footer-inner">
                <div class="footer-left-text">ТутУслуги – маркетплейс услуг © {{ now()->year }}</div>
                <div class="footer-right-links">
                    <ul>
                        <li><a href="/{{$CityRegion->url}}/sitemap/">Все услуги</a></li>
                        <li><a href="{{route('contacts')}}/">Служба поддержки</a></li>
                        <li><a href="{{route('userterms')}}/">Пользовательское соглашение</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
</div>
@yield('scripts')
</body>
</html>
