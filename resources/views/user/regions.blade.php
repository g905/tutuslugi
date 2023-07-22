@extends('layouts.app')

@section('content')
    <div class="container">
        @include("user.menu")
        <div class="page-col-inner">


            <div class="page-col-left s-895">


                <div class="user-cabinet-section">
                    <div class="user-cabinet-title">
                        <a href="{{route('user.profile')}}"><i>
                                <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M8.54689 0.227009C8.61882 0.298889 8.67588 0.384239 8.71482 0.478182C8.75375 0.572125 8.77379 0.672818 8.77379 0.774509C8.77379 0.8762 8.75375 0.976893 8.71482 1.07084C8.67588 1.16478 8.61882 1.25013 8.54689 1.32201L2.64289 7.22601H15.2259C15.4312 7.22601 15.628 7.30756 15.7732 7.45271C15.9183 7.59786 15.9999 7.79473 15.9999 8.00001C15.9999 8.20529 15.9183 8.40216 15.7732 8.54731C15.628 8.69246 15.4312 8.77401 15.2259 8.77401H2.64289L8.54689 14.678C8.6204 14.7495 8.67897 14.8348 8.71922 14.9291C8.75946 15.0234 8.78057 15.1248 8.78131 15.2273C8.78205 15.3299 8.76242 15.4315 8.72355 15.5264C8.68468 15.6213 8.62735 15.7075 8.55488 15.78C8.48242 15.8525 8.39626 15.9099 8.30142 15.9489C8.20658 15.9879 8.10495 16.0076 8.00242 16.0069C7.8999 16.0063 7.79852 15.9853 7.70418 15.9451C7.60985 15.905 7.52443 15.8465 7.45289 15.773L0.226887 8.54701C0.0819179 8.40188 0.000488281 8.20514 0.000488281 8.00001C0.000488281 7.79488 0.0819179 7.59814 0.226887 7.45301L7.45289 0.227009C7.59802 0.08204 7.79476 0.000610352 7.99989 0.000610352C8.20502 0.000610352 8.40176 0.08204 8.54689 0.227009Z"
                                          fill="black"/>
                                </svg>
                            </i></a> Города
                    </div>


                    <section class="user-text-default">


                        <label class="pre-form-text-info">
                            Укажите удобные для работы города и районы
                        </label>


                        <form method="POST" action="{{ route('user.regions') }}/" name="form-user-regions" class="form-user-regions">
                            @csrf
                            <div class="form-ui-style-default">
                                @if(!empty($Regions))
                                    @foreach($Regions as $region)

                                            <div class="regions-list-item">
                                                <div class="regions-list-item-name">{{$region->name}} <i><svg width="11" height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.230017 1.20999C0.373276 1.07216 0.565395 0.996848 0.764157 1.0006C0.962918 1.00435 1.15206 1.08686 1.29002 1.22999L5.00002 5.16799L8.71002 1.22999C8.77745 1.15565 8.85913 1.0956 8.9502 1.0534C9.04127 1.01119 9.13988 0.987704 9.2402 0.984314C9.34052 0.980925 9.44049 0.997706 9.53421 1.03366C9.62792 1.06962 9.71346 1.12402 9.78576 1.19365C9.85806 1.26327 9.91565 1.3467 9.95512 1.43899C9.99458 1.53127 10.0151 1.63055 10.0155 1.73092C10.0159 1.83129 9.99616 1.93072 9.95743 2.02332C9.91869 2.11592 9.86176 2.1998 9.79002 2.26999L5.54002 6.76999C5.47005 6.84258 5.38618 6.90032 5.29339 6.93975C5.20061 6.97919 5.10083 6.99951 5.00002 6.99951C4.8992 6.99951 4.79942 6.97919 4.70664 6.93975C4.61386 6.90032 4.52998 6.84258 4.46002 6.76999L0.210017 2.26999C0.0721872 2.12674 -0.0031283 1.93462 0.000621912 1.73585C0.00437213 1.53709 0.0868812 1.34795 0.230017 1.20999Z" fill="#0E1D45"/>
                                                        </svg>
                                                    </i></div>
                                                <div class="regions-list-city">
                                                    @if(!empty($region->citys))
                                                        @foreach($region->citys as $city)
                                                            <div class="regions-list-item-city">
                                                                <label class="checkbox-style">
                                                                    <input @if(!empty($UserRegions[$city->id])) checked @endif name="city[]" type="checkbox" value="{{$city->id}}">
                                                                    <span class="checkmark"></span>
                                                                    {{$city->name}}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    <div class="save-from-sectin-slide">
                                                        <button type="submit" class="btn btn-primary">
                                                            Сохранить
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>


                                    @endforeach
                                @endif

                                    @section('scripts')
                                <script>
                                    $(function (){

                                       $(".checkbox-style").each(function (){
                                            $(this).find('input:checked').closest('.regions-list-item-name').addClass("show");
                                            $(this).find('input:checked').closest('.regions-list-city').addClass("show");
                                       });
                                    });
                                </script>
                                    @endsection










                                <div class="form-group save-from-sectin-slide-main">
                                    <div class="d-flex justify-content-between form__buttons align-items-center">
                                        <button type="submit" class="btn btn-primary ignore-size">
                                            Сохранить
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>


                </div>
            </div>
        </div>
    </div>
@endsection

