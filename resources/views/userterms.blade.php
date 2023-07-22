@extends('layouts.app')

@section('content')
    <div class="page__bread__crumbs">
        <div class="container">

            <a @if(!empty($CityRegion->url)) href="/{{$CityRegion->url}}/" @else href="/" @endif >Главная</a> · <span>{{$dataPageDefault->h1}}</span>
        </div>
    </div>


    <div class="container">

        <div class="page-col-inner">
            <div class="page-col-left s-910">
                <h1 class="page__section_title_two">{{$dataPageDefault->h1}}</h1>


                {!! $dataPageDefault->text !!}



            </div>

        </div>


    </div>

@endsection
