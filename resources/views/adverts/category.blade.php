@extends('layouts.app')

@section('content-top')
    <section class="home-section-one">
        <div class="container">
            <h1 class="home-section-one__title">@if(!empty($dataPageDefault->h1)){{$dataPageDefault->h1}}@endif</h1>
            <div class="home-section-one__text">@if(!empty($dataPageDefault->text)){!! $dataPageDefault->text !!}@endif
            </div>
        </div>
    </section>


    <section class="home-section-categories" id="home-categories">
        <div class="container">


            <div class="categories__section__block">
                <ul>
                    @if(!empty($SubCategories))
                        @foreach($SubCategories as $Category)
                            <li>
                                <a href="/{{$CityRegion->url}}/{{$CheckCategory->url}}/{{$Category['url']}}/">{{$Category['name']}}</a>
                            </li>
                        @endforeach

                    @else
                        @foreach($pop as $Category)
                            <li>
                                <a href="/{{$CityRegion->url}}/{{$CheckCategory->url}}/{{$Category['url']}}/">{{$Category['name']}}</a>
                            </li>
                        @endforeach

                    @endif

                </ul>
            </div>

        </div>
    </section>
@endsection
@section('content')

    <section class="home-section-items">
        <div class="container">
            <div class="page-col-inner">
                <div class="page-col-left s-895">
                    <div class="section__items">


                        {{--
                         @include("advert.list-item")
                         @include("advert.list-item")
                         @include("advert.list-item")--}}


                        @if(!empty($Users))

                            @foreach($Users as $user)

                                @include("advert.list-item",['user_data'=>$user])
                                {{--<div class="section__items-item">
                                    <div class="section__items-item-head">
                                        <a href="{{$advert['region_data']['url']}}/">{{$advert['region_data']['name']}}</a>
                                        /
                                        <a href="{{$advert['category_data']['url']}}/">{{$advert['category_data']['name']}}</a>
                                        @if(!empty($advert['subcategory_data']['name']))/
                                        <a href="{{$advert['subcategory_data']['url']}}/">{{$advert['subcategory_data']['name']}}</a>
                                            @endif
                                    </div>
                                    <div class="section__items-item-middle">
                                        @if(!empty($advert['images']['path']))
                                        <div class="section__items-item-middle-left">
                                            <div class="section__items-item-image">
                                                <div class="count">{{$advert['images_count']}}</div>
                                                <span class="data-link-a" data-link="{{$advert['region_data']['url']}}/{{$advert['category_data']['slug']}}@if($advert['subcategory_data']['slug'])/{{$advert['subcategory_data']['slug']}}@endif/t-{{$advert->id}}">
                                                    @if(!empty($advert['images']['path']))
                                                        <img
                                                            class="lazy" data-src="{{ asset("storage/".$advert['images']['path']) }}"/>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="section__items-item-middle-right  @if(empty($advert['images']['path'])) full--width @endif">
                                            <div class="section__items-item-title">
                                                <span class="data-link-a" data-link="{{$advert['region_data']['url']}}/{{$advert['category_data']['slug']}}@if($advert['subcategory_data']['slug'])/{{$advert['subcategory_data']['slug']}}@endif/t-{{$advert->id}}">{{$advert->name}}</span>
                                            </div>
                                            <div class="section__items-item-stikers">
                                                <span class="profi">Профи</span>
                                                <span class="top">Топ</span>
                                            </div>

                                            <div class="section__items-item-description">{!! \Illuminate\Support\Str::limit(strip_tags($advert->text), 220, $end='...')  !!}</div>

                                            <div class="section__items-item-information">
                                                {{$advert->user_name}} / {{$advert['region_data']['name']}} /
                                                <b>{{$advert->phone}}</b>
                                            </div>


                                            <div class="section__items-item-prices">
                                                @if(!empty($advert['pricecs']))

                                                    @foreach($advert['pricecs'] as $key=>$price)
                                                        @if($key>2)
                                                            @break
                                                        @endif
                                                        <div class="price-row">
                                                            <span>{{$price->name}}</span>
                                                            <span>@if($price->price) ₽ {{$price->price}} / {{$MeasureList[$price->masure]}} @else по договоренности @endif</span>
                                                        </div>

                                                    @endforeach
                                                @if(count($advert['pricecs'])>3)
                                                            <div class="price-row last">
                                                                <a href="#">Все услуги и цены ({{count($advert['pricecs'])}})</a>
                                                            </div>
                                                 @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>--}}
                            @endforeach
                        @endif
                    </div>

                    {{-- @if(!empty($BannersPages[1]))
                         <div class="horizontal-img-bnr">
                             <a target="_blank" href="{{$BannersPages[1]->link}}">
                                 <img src="{{$BannersPages[1]->path}}"/>
                             </a>
                         </div>
                     @endif--}}

                </div>
                <div class="page-col-right s-300">

                    @if(!empty($BannersPages[0]->path))
                        <div class="vertical-img-bnr">
                            <a target="_blank" href="{{$BannersPages[0]->link}}">
                                <img src="{{$BannersPages[0]->path}}"/>
                            </a>
                        </div>
                    @endif

                    @if(!empty($side))
                        <div class="side-links">
                        @foreach ($side as $svc)
                            <a target="_blank" href="#">{{ $svc->name }}</a>
                        @endforeach
                        </div>
                    @endif
                </div>
            </div>


        </div>
    </section>
@endsection
