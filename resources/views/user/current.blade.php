@extends('layouts.app')
@section('content')




    <section class="home-section-items">
        <div class="container">
            <div class="page-col-inner">
                <div class="page-col-left s-895">
                    <div class="section__items">

                        <div class="section__items-item">
                            <div class="section__items-item-left">
                                <div class="section__items-image">
                                    @if(!empty($User->photo))
                                        <img src='{{asset("storage/".$User->photo)}}'/>
                                    @else
                                        <img src="/images/user-avatar-default.png" />
                                    @endif

                                </div>
                                {{--<div class="section__items-info">
                                                            <span><i>
                                                                    <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.43 0.524002C4.60254 0.174547 6.79954 -0.000677609 9 1.96909e-06C11.236 1.96909e-06 13.43 0.180002 15.57 0.524002C17.007 0.755002 18 2.014 18 3.426V8.574C18 9.987 17.007 11.244 15.57 11.476C13.8546 11.7521 12.1235 11.9195 10.387 11.977C10.1889 11.9819 10.0002 12.062 9.859 12.201L6.28 15.781C6.17505 15.8858 6.04138 15.9572 5.89589 15.986C5.7504 16.0149 5.59962 15.9999 5.46261 15.9431C5.32561 15.8863 5.20854 15.7901 5.12619 15.6667C5.04385 15.5433 4.99993 15.3983 5 15.25V11.807C4.14007 11.7241 3.28298 11.614 2.43 11.477C0.993 11.244 0 9.986 0 8.573V3.426C0 2.013 0.993 0.756002 2.43 0.524002Z" fill="#8695BD"/>
                        </svg>
                        </i> 0 отзывов</span>
                                    <span>
                            <i><svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.661 0.23698C7.75629 0.157943 7.8762 0.114685 8 0.114685C8.1238 0.114685 8.24371 0.157943 8.339 0.23698C10.3366 1.89864 12.8215 2.86373 15.417 2.98598C15.534 2.98958 15.6459 3.03408 15.7335 3.11174C15.821 3.18939 15.8785 3.29529 15.896 3.41098C15.965 3.93098 16 4.46098 16 5.00098C16 10.163 12.74 14.564 8.166 16.257C8.05886 16.2965 7.94114 16.2965 7.834 16.257C3.26 14.564 0 10.163 0 4.99998C0 4.46198 0.0350001 3.93098 0.104 3.41098C0.121528 3.29512 0.17919 3.1891 0.266919 3.11142C0.354649 3.03375 0.466873 2.98935 0.584 2.98598C3.17927 2.86323 5.66379 1.89779 7.661 0.23598V0.23698ZM11.857 6.19098C11.974 6.02999 12.0222 5.82914 11.991 5.6326C11.9599 5.43606 11.852 5.25994 11.691 5.14298C11.53 5.02602 11.3292 4.9778 11.1326 5.00893C10.9361 5.04006 10.76 5.14799 10.643 5.30898L7.16 10.099L5.28 8.21898C5.21078 8.14738 5.128 8.09028 5.03647 8.05102C4.94495 8.01176 4.84653 7.99112 4.74694 7.9903C4.64736 7.98948 4.54861 8.0085 4.45646 8.04626C4.3643 8.08401 4.28059 8.13974 4.2102 8.21019C4.13982 8.28064 4.08417 8.36441 4.0465 8.4566C4.00883 8.54879 3.9899 8.64756 3.99081 8.74714C3.99173 8.84672 4.01246 8.94513 4.05181 9.03661C4.09116 9.1281 4.14834 9.21083 4.22 9.27998L6.72 11.78C6.79663 11.8567 6.88896 11.9158 6.99065 11.9534C7.09233 11.9909 7.20094 12.006 7.30901 11.9975C7.41708 11.9891 7.52203 11.9573 7.61663 11.9044C7.71123 11.8514 7.79324 11.7786 7.857 11.691L11.857 6.19098Z" fill="#FD5CBB"/>
                        </svg>
                        </i> Документы подтверждены
                        </span>

                                </div>--}}
                            </div>
                            <div class="section__items-item-right">
                                <div class="section__items-item-top">
                                    <div class="section__items-item-top-left">
                                        <div class="section__items-item-categories">
                                            @if(!empty($User->categories))
                                                @foreach($User->categories as $key=>$category)
                                                    <a href="#">{{$category->master_1}}@if($User->categories->count()>$key+1), @endif</a>
                                                @endforeach
                                            @endif

                                        </div>

                                        <div class="section__items-item-title">
                                            <a href="/user/{{$User->id}}">{{$User->name}}</a>
                                        </div>
                                    </div>




                                </div>

                                <div class="section__items-item-buttons current-user">
                                    <a href="#" class="btn-phone"  date-get-phone="{{$User->id}}">+{{$User->phone}}</a>
                                    {{-- <a href="#" class="btn-message">Написать сообщение</a>--}}
                                </div>

                                <div class="section__items-item-info">
                                    <p>Стаж работы {{$User->work_experience}} лет</p>
                                    <p>
                                        {{$User->about_text}}
                                    </p>
                                </div>

                                @if(!empty($User->discount_text))
                                    <div class="section__items-item-discount">
                                        <span>{{$User->discount}}%</span> {{$User->discount_text}}
                                    </div>
                                @endif

                                @if(!empty($User->photos))
                                    <div class="section__items-item-gallery">
                                        <div class="swiper item-gallery">
                                            <div class="swiper-wrapper">
                                                @foreach($User->photos as $photo)
                                                    <div class="swiper-slide">
                                                        <a href="{{ asset("storage".str_replace("_small","_big",$photo->path)) }}" data-fancybox="gallery">
                                                            <img src="{{ asset("storage".$photo->path) }}" />
                                                        </a>
                                                    </div>
                                                @endforeach
                                                @foreach($User->photos as $photo)
                                                    <div class="swiper-slide">
                                                        <a href="{{ asset("storage".str_replace("_small","_big",$photo->path)) }}" data-fancybox="gallery">
                                                            <img src="{{ asset("storage".$photo->path) }}" />
                                                        </a>
                                                    </div>
                                                @endforeach
                                                @foreach($User->photos as $photo)
                                                    <div class="swiper-slide">
                                                        <a href="{{ asset("storage".str_replace("_small","_big",$photo->path)) }}" data-fancybox="gallery">
                                                            <img src="{{ asset("storage".$photo->path) }}" />
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif


                                <div class="section__items-item-prices">
                                    @if(!empty($User->services))
                                        @foreach($User->services as $key=>$service)
                                            @if($key<=3)
                                                <div class="price-row">
                                                    <span>{{$service->name}}</span>
                                                    @if($service->price)
                                                        <span> ₽ {{ $service->price}} / {{$MeasureList[$service->measure]}} </span>
                                                    @else
                                                        <span>по договоренности</span>
                                                    @endif

                                                </div>
                                            @endif
                                        @endforeach
                                    @endif

                                    <div class="price-row last">
                                        <a href="#">Все услуги и цены ({{$User->services->count()}})</a>
                                    </div>
                                </div>




                            </div>

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
