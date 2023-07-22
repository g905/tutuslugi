@extends('layouts.app')

@section('content')
    <div class="page__bread__crumbs">
        <div class="container">

            <a @if(!empty($CityRegion->url)) href="/{{$CityRegion->url}}/" @else href="/" @endif >Главная</a> · <span>{{$dataPageDefault->h1}}</span>
        </div>
    </div>


    <div class="container">

        <div class="page-col-inner">
            <div class="page-col-left s-100">
                <h1 class="page__section_title_two">{{$dataPageDefault->h1}}</h1>


                @if(!empty($SEOPages))
                    <div class="row site-map">
                    @foreach($SEOPages as $seo)
                        <div class="col-md-3">
                            <a href="/{{$CityRegion->url}}/{{$seo->url}}/">{{$seo->name}}</a>
                        </div>
                    @endforeach
                    </div>
                @endif



            </div>

        </div>


    </div>

@endsection
