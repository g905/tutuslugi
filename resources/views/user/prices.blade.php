<form method="POST" action="{{ route('user.service.price') }}/" name="form-user-services-price" class="form-user-services-price">
    @csrf
    <div class="form-ui-style-default">
        @if(!empty($Services))
            @foreach($Services as $service)
                {{--    @if(empty($service->children)||count($service->children)==0)
                        @continue
                    @endif--}}

                <div class="regions-list-item">
                    <div class="regions-list-item-name">{{$service->category->name}} <i><svg width="11" height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.230017 1.20999C0.373276 1.07216 0.565395 0.996848 0.764157 1.0006C0.962918 1.00435 1.15206 1.08686 1.29002 1.22999L5.00002 5.16799L8.71002 1.22999C8.77745 1.15565 8.85913 1.0956 8.9502 1.0534C9.04127 1.01119 9.13988 0.987704 9.2402 0.984314C9.34052 0.980925 9.44049 0.997706 9.53421 1.03366C9.62792 1.06962 9.71346 1.12402 9.78576 1.19365C9.85806 1.26327 9.91565 1.3467 9.95512 1.43899C9.99458 1.53127 10.0151 1.63055 10.0155 1.73092C10.0159 1.83129 9.99616 1.93072 9.95743 2.02332C9.91869 2.11592 9.86176 2.1998 9.79002 2.26999L5.54002 6.76999C5.47005 6.84258 5.38618 6.90032 5.29339 6.93975C5.20061 6.97919 5.10083 6.99951 5.00002 6.99951C4.8992 6.99951 4.79942 6.97919 4.70664 6.93975C4.61386 6.90032 4.52998 6.84258 4.46002 6.76999L0.210017 2.26999C0.0721872 2.12674 -0.0031283 1.93462 0.000621912 1.73585C0.00437213 1.53709 0.0868812 1.34795 0.230017 1.20999Z" fill="#0E1D45"/>
                            </svg>
                        </i></div>
                    <div class="regions-list-city">
                        @if(!empty($service->children))
                            @foreach($service->children as $scategory)
                                <div class="regions-list-item-city regions-list-item-city-service">

                                    <label class="checkbox-style">
                                        <input @if(!empty($UserCategories[$scategory->id])) checked @endif name="service[{{$service->category->id}}][]" class="user-profile-service-input" type="checkbox" @if(!empty($scategory->service)) checked @endif value="{{$scategory->id}}">
                                        <span class="checkmark"></span>
                                        {{$scategory->name}}
                                    </label>

                                    <div class="service-price-input">
                                        <input type="text" name="service_price[{{$scategory->id}}][]"  @if(!empty($scategory->service)) value="{{$scategory->service->price}}" @else disabled @endif >
                                        {{$MeasureList[$scategory->measure]}}
                                    </div>

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
        <div class="form-group save-from-sectin-slide-main">
            <div class="d-flex justify-content-between form__buttons align-items-center">
                <button type="submit" class="btn btn-primary ignore-size">
                    Сохранить
                </button>

            </div>
        </div>
    </div>
</form>
