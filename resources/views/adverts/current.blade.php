@extends('layouts.app')

@section('scripts')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"
    />

    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function(){
            $('.portfolio-slider').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                infinite:false,
                arrows: true,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    }
                    ]
            });
        });
    </script>
@endsection
@section('content')
    <div class="page__bread__crumbs">
        <div class="container">
            @if(!empty($CheckParentCategory))
                <a href="/{{$CityRegion->url}}/">{{$CityRegion->name}}</a> · <a
                    href="/{{$CityRegion->url}}/{{$CheckParentCategory->url}}/">{{$CheckParentCategory->name}}</a>
                @if(!empty($CheckCategory))  ·
                <a href="/{{$CityRegion->url}}/{{$CheckParentCategory->url}}/{{$CheckCategory->url}}/">{{$CheckCategory->name}}</a>@endif · <span>{{$advert->name}}</span>
            @else
                <a href="/{{$CityRegion->url}}/">{{$CityRegion->name}}</a> · <span>{{$CheckCategory->name}}</span>
            @endif

        </div>
    </div>


    <div class="container">

        <div class="page-col-inner">
            <div class="page-col-left s-910">{{--
                <div class="page__section_title_two">{{$CheckCategory->name}} в {{$CityRegion->name_case}}</div>--}}

                <div class="current-item-page">
                    <div class="current-item-page-left">
                        <h1 class="current-item-page-title">{{$advert->name}} <button data-wish-item-id="{{$advert['id']}}" class="wishlist @if($advert['wish_active']==1)active @endif"><i></i></button></h1>
                        <div class="current-item-page-description">{{$advert->text}}

                        <a class="current-item-page-description-show" href="#">Развернуть</a>
                        </div>
                        @if(!empty($advert['images_all'])&&$advert['images_all']->isNotEmpty())
                        <div class="current-item-page-title-section">Примеры работ</div>
                        <div class="portfolio-slider-inner">
                            <div class="portfolio-slider">

                                    @foreach($advert['images_all'] as $image)
                                        <div><a  data-fancybox="gallery" href="{{ asset("storage/".$image['path']) }}">
                                            <img
                                                class="lazy" data-src="{{ asset("storage/".$image['path']) }}"/></a>
                                        </div>
                                    @endforeach


                            </div>
                        </div>
                        @endif
                        @if(!empty($advert['pricecs'])&&count($advert['pricecs'])>0)
                        <div class="current-item-page-title-section">Услуги и цены</div>
                        <div class="section__items-item-prices">


                                @foreach($advert['pricecs'] as $key=>$price)
                                    @if($key>2)
                                        @break
                                    @endif
                                    <div class="price-row">
                                        <span>{{$price->name}}</span>
                                        <span>@if($price->price) ₽ {{$price->price}}
                                            / {{$MeasureList[$price->masure]}} @else по
                                            договоренности @endif</span>
                                    </div>

                                @endforeach
                                @if(count($advert['pricecs'])>3)
                                    <div class="price-row last">
                                        <a href="#">Все услуги и цены ({{count($advert['pricecs'])}})</a>
                                    </div>
                                @endif
                                    @foreach($advert['pricecs'] as $key=>$price)
                                    @if($key>2)


                                    <div class="price-row d-none">
                                        <span>{{$price->name}}</span>
                                        <span>@if($price->price) ₽ {{$price->price}}
                                            / {{$MeasureList[$price->masure]}} @else по
                                            договоренности @endif</span>
                                    </div>
                                        @endif
                                @endforeach


                        </div> @endif


                        @if($advert->import_id!=0)
                        <div class="advert-current-contacts-form">
                            <div class="current-item-page-title-section">Свяжитесь с мастером</div>
                            <form method="post" action="{{route('contacts.send')}}/" name="contacts-form">
                                @csrf

                                <input type="hidden" class="form-control" name="contacts[adv_id_current]" value="{{$advert->id}}"/>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Ваши контакты (телефон или почта)</label>
                                        <input type="text" class="form-control" name="contacts[contact]"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Ваше сообщение</label>
                                        <textarea class="form-control" maxlength="2000" name="contacts[text]"></textarea>
                                    </div>
                                </div>

                                <div class="form-validation-errors"></div>

                                <div style="display: none;">
                                    <input type="text" class="form-control" name="email"/>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            Отправить
                                        </button>
                                    </div>
                                </div>

                            </form>
                    </div>
                        @endif




                        <div class="current-item-full-info">
                            <div>№{{$advert->id}} / {{$advert['date_start_format']}} /  {{$advert->views}} просм.</div>
                            @if(!empty(Auth::user()->user_type)&&Auth::user()->user_type==2)
                                <div><a target="_blank" href="{{route('admin.items.edit',$advert->id)}}" class="btn btn-light">Редактировать</a></div>
                            @endif
                            <div><a  href="{{route('contacts')}}/?advert_id={{$advert->id}}" class="btn btn-light">Пожаловаться</a></div>
                        </div>

                        @if(!empty($BannersPages[5]))
                            <div class="horizontal-img-bnr">
                                <a target="_blank" href="{{$BannersPages[5]->link}}">
                                    <img src="{{$BannersPages[5]->path}}"/>
                                </a>
                            </div>
                        @endif

                    </div>
                    <div class="current-item-page-right">
                        @if(!empty($advert['user_info']->phone) || !empty($advert['phone']))
                        <button class="btn btn-primary" type="button" id="show-item-number" data-item-id="{{$advert->id}}">
                            <b>Показать номер</b>
                            @if(!empty($advert['user_info']->phone))
                            {{$advert['user_info']->phone}}
                            @else
                                {{$advert['phone']}}
                            @endif
                        </button>
                        @endif

                        @if($advert->import_id!=0)
                            <button class="btn btn-primary go-contacts-from" type="button" id="go-contacts-from">
                                Написать сообщение
                            </button>
                        @endif

                        <div class="item-user-info">
                            <b> @if(!empty($advert['user_info']->name))
                                    {{$advert['user_info']->name}}
                                @else
                                    {{$advert['user_name']}}
                                @endif</b><br/>
                            Контактное лицо
                        </div>

                    </div>


                </div>


                @if(!empty($Adverts)&&count($Adverts)>0)
                    <div class="current-item-page-title">Другие услуги эксперта</div>
                    @foreach($Adverts as $advert)
                        @include('adverts.listitem')
                    @endforeach




                @endif

            </div>
            <div class="page-col-right s-300">
                @if(!empty($BannersPages[4]))
                    <div class="vertical-img-bnr">
                        <a target="_blank" href="{{$BannersPages[4]->link}}">
                            <img src="{{$BannersPages[4]->path}}"/>
                        </a>
                    </div>
                @endif
            </div>





        </div>


    </div>


@endsection
