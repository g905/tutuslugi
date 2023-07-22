@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="page-col-inner">
            <div class="page-col-left s-300">
                @include("user.menu")

            </div>
            <div class="page-col-right s-910">
                <h1 class="page__section_title_one">Избранное</h1>

                <div class="section__items">
                    @if(!empty($Adverts))

                        @foreach($Adverts as $advert)
                            @include('adverts.listitem')
                        @endforeach


                    @endif
                </div>
            </div>
        </div>




    </div>
@endsection
