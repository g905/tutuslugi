@extends('layouts.app')

@section('content')

    <section class="home-section-items">
        <div class="container">
            <div class="page-col-inner">
                <div class="page-col-left s-895">

                    <div class="section-select-region">
                        @if(!empty($BreadsRegion))
                            <h1 class="page__section_title_two">Услуги {{$BreadsRegion[0]}}</h1>
                        @else
                            <h1 class="page__section_title_two">Город</h1>
                            @endif

        @if(!empty($BreadsRegion))
            <div class="regions-breadcrumbs">
                @foreach($BreadsRegion as $Link=>$Name)
                    @if($Link!='')
                        <a href="{{$Link}}/">{{$Name}}</a>
                    @else
                        / {{$Name}}
                    @endif
                @endforeach
            </div>
        @endif
        <div class="regions__list__items">
            @if(!empty($Regions))
                @foreach($Regions as $Region)
                    <div class="regions__list__items-col">
                        @foreach($Region as $region)
                            <div class="regions__list__items-item @if($region['favorite']==1)active @endif">
                                @if($region['parent_id']==0)
                                    <a href="/region/{{$region['id']}}/">{{$region['name']}}</a>
                                @else
                                    <a href="/{{$region['url']}}/">{{$region['name']}}</a>
                                @endif

                                <span class="count">{{$region->GetAdvertsCountByRegion()}}</span>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif

        </div>
                    </div>
    </div>

                <div class="page-col-right s-300">
                    @if(!empty($BannersPages[0]->path))
                        <div class="vertical-img-bnr">
                            <a target="_blank" href="{{$BannersPages[0]->link}}">
                                <img src="{{$BannersPages[0]->path}}"/>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>


@endsection
