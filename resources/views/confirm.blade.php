@extends('layouts.app')

@section('content')
    <div class="page__bread__crumbs">
        <div class="container">

            <a @if(!empty($CityRegion->url)) href="/{{$CityRegion->url}}" @else href="/" @endif >Главная</a> · <span>Подтверждение регистрации</span>
        </div>
    </div>


    <div class="container">

        <div class="page-col-inner">
            <div class="page-col-left s-910">
                <h1 class="page__section_title_two">Подтверждение регистрации</h1>
                <p>Вам необходимо подтвердить регистрацию по ссылке, которая была отправлена вам, при регистрации на почту.</p>





            </div>

        </div>


    </div>

@endsection
