<div class="section__items-item">
    <div class="section__items-item-left">
        <div class="section__items-image">
            @if(!empty($user_data->photo))
            <img src='{{asset("storage/".$user_data->photo)}}'/>
            @else
            <img src="/images/user-avatar-default.png" />
            @endif

        </div>
    </div>
    <div class="section__items-item-right">
        <div class="section__items-item-top">
            <div class="section__items-item-top-left">
                <div class="section__items-item-categories">
                    @if(!empty($user_data->categories))
                    @foreach($user_data->categories as $key=>$category)
                    <a href="#">{{$category->master_1}}@if($user_data->categories->count()>$key+1), @endif</a>
                    @endforeach
                    @endif

                </div>

                <div class="section__items-item-title">
                    <a href="/user/{{$user_data->id}}">{{$user_data->name}}</a>
                </div>
            </div>
            <div class="section__items-item-top-right">
                @include("buttons.wishlist")
            </div>

        </div>

        <div class="section__items-item-info">
            <p>Стаж работы {{$user_data->work_experience}} лет</p>
            <p>
                {{$user_data->about_text}}
            </p>
        </div>

        @if(!empty($user_data->discount_text))
        <div class="section__items-item-discount">
            <span>{{$user_data->discount}}%</span> {{$user_data->discount_text}}
        </div>
        @endif

        @if(!empty($user_data->photos))
        <div class="section__items-item-gallery">
            <div class="swiper item-gallery">
                <div class="swiper-wrapper">
                    @foreach($user_data->photos as $photo)
                    <div class="swiper-slide">
                        <a href="{{ asset("storage".str_replace("_small","_big",$photo->path)) }}" data-fancybox="gallery">
                            <img src="{{ asset("storage".$photo->path) }}" />
                        </a>
                    </div>
                    @endforeach
                    @foreach($user_data->photos as $photo)
                    <div class="swiper-slide">
                        <a href="{{ asset("storage".str_replace("_small","_big",$photo->path)) }}" data-fancybox="gallery">
                            <img src="{{ asset("storage".$photo->path) }}" />
                        </a>
                    </div>
                    @endforeach
                    @foreach($user_data->photos as $photo)
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
            @if(!empty($user_data->services))
            @foreach($user_data->services as $key=>$service)
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

            @if($user_data->services)
            <div class="price-row last">
                <a href="#">Все услуги и цены ({{$user_data->services->count()}})</a>
            </div>
            @endif
        </div>

        <div class="section__items-item-buttons">
            <a href="#" class="btn-phone" date-get-phone="{{$user_data->id}}">+{{$user_data->phone}}</a>
            {{-- <a href="#" class="btn-message">Написать сообщение</a>--}}
        </div>


    </div>

</div>
