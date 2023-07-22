<div class="section__items-item">

    <div class="section__items-item-middle">
        @if(!empty($advert['images']['path']))
            <div class="section__items-item-middle-left">
                <div class="section__items-item-image">
                    <div class="count">{{$advert['images_count']}}</div>
                    <span class="data-link-a" data-link="{{$advert['region_data']['url']}}/{{$advert['category_data']['slug']}}@if($advert['subcategory_data']['slug'])/{{$advert['subcategory_data']['slug']}}@endif/t-{{$advert->id}}">
                        @if(!empty($advert['images']['path']))
                            @if(!empty($isajax)&&$isajax==1)
                                <img src="{{ asset("storage/".$advert['images']['path']) }}"/>
                            @else
                                <img
                                    class="lazy" data-src="{{ asset("storage/".$advert['images']['path']) }}"/>
                                @endif

                        @endif
                    </span>
                </div>
            </div>
        @endif
        <div
            class="section__items-item-middle-right @if(empty($advert['images']['path'])) full--width @endif">
            <div class="section__items-item-title">
                <span class="data-link-a" data-link="{{$advert['region_data']['url']}}/{{$advert['category_data']['slug']}}@if($advert['subcategory_data']['slug'])/{{$advert['subcategory_data']['slug']}}@endif/t-{{$advert->id}}">
                    @if((!empty($SeoPage)&&$SeoPage==1&&!empty($CheckCategory->name_adv)&&$CheckCategory->name_adv==1&&!empty($advert['user_info']->name)) OR (!empty($CheckCategory)&&$CheckCategory->name_adv==1)) {{$advert->user_name}}:  @endif{{$advert->name}}</span>

                <button data-wish-item-id="{{$advert['id']}}" class="wishlist @if($advert['wish_active']==1)active @endif"><i></i></button>
            </div>
            <div class="section__items-item-stikers">
                <span class="profi">Профи</span>
                <span class="top">Топ</span>
            </div>

            <div class="section__items-item-description">

                @if(!empty($CheckCategory->show_short_description) && $CheckCategory->show_short_description==1)
                    {!! \Illuminate\Support\Str::limit(strip_tags($advert->text), 220, $end='...')  !!}
                @endif
            </div>

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
                            <span>@if($price->price) ₽ {{$price->price}}
                                / {{$MeasureList[$price->masure]}} @else по
                                договоренности @endif</span>
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


    {{--<div class="row">
        <div class="col-12 col-md-4 col-sm-12 col-xl-3 pb-2">

        </div>
        <div class="col-12 col-md-8  col-sm-12 col-xl-9">
            <h5 class="card-title">{{$advert->name}}</h5>


            <p class="card-text">{!! \Illuminate\Support\Str::limit(strip_tags($advert->text), 290, $end='...')  !!}</p>

            <p class="card-text">Цена: {{$advert->price}} руб.</p>
            <p class="card-text">Имя: {{$advert['user_info']->name}} |
                Телефон: {{$advert['user_info']->phone}} |
                E-mail: {{$advert['user_info']->email}}</p>


        </div>
    </div>--}}

</div>
