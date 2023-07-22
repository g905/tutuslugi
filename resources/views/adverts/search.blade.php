@extends('layouts.app')

@section('content')
    <div class="page__bread__crumbs">
        <div class="container">
            <a href="/{{$CityRegion->url}}/">{{$CityRegion->name}}</a> · <span>Поиск</span>
        </div>
    </div>


    <div class="container">

        <div class="page-col-inner">
            <div class="page-col-left s-910">
                <div class="page__section_title_two">Поиске в {{$CityRegion->name_case}}: {{$searchText}}</div>

                <div class="regions__list__items">
                    @if(!empty($SubCategories))
                        @foreach($SubCategories as $Category)
                            <div class="regions__list__items-col">
                                @foreach($Category as $category)
                                    <div class="regions__list__items-item">
                                        <a href="/{{$CityRegion->url}}/{{$CheckCategory->url}}/{{$category['url']}}/">{{$category['name']}}</a>

                                        <span class="count">{{$category['adverts_count']}}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    @endif

                </div>
                @if(!empty($SubCategories))
                    <div class="regions__list__items">
                        <div class="regions__list__items__title">Популярные услуги</div>

                        @foreach($SubCategories as $Category)
                            <div class="regions__list__items-col">
                                @foreach($Category as $category)
                                    <div class="regions__list__items-item">
                                        <a href="/{{$CityRegion->url}}/{{$CheckCategory->url}}/{{$category['url']}}/">{{$category['name']}}</a>

                                        <span class="count">{{$category['adverts_count']}}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach


                    </div>
                @endif
                <div class="section__items section__items-category-page">
                    @if($Adverts->isNotEmpty())
                    @else
                        <p>Объявления не найдены</p>
                    @endif
                    @if(!empty($Adverts))

                        @foreach($Adverts as $advert)
                                @include('adverts.listitem')
                        @endforeach




                    @endif
                </div>

            </div>
            <div class="page-col-right s-300">
                <img src="/images/test.png"/>
            </div>
        </div>


    </div>

@endsection
