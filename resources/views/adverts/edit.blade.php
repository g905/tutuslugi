@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="advert-edit-form">
            <div class="page__user__title">Редактирвоание услуги</div>
            <form method="POST" enctype="multipart/form-data" action="{{ route('advert.edit') }}/" name="form-advert-edit">
                @csrf
                @if(!empty($Item->id))
                    <input type="hidden" name="item_id" value="{{$Item->id}}"/>
                @endif
                <div class="form-group row">

                    <div class="col-md-12">
                        <div class="alert alert-warning" role="alert">
                            <p><small>Профиль пользователя</small></p>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Имя</label>
                                        <input type="text" class="form-control" value="{{$Item->user_name}}" name="advert[user_name]"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Телефон</label>
                                        <input type="text" class="form-control phone-mask" value="{{str_replace('+7','',$Item->phone_clear)}}" name="advert[user_phone]" />
                                    </div>
                                </div>


                        </div>

                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="adv-form-location">Местоположение</label>
                        <select class="form-control" id="adv-form-location" name="advert[region]">
                            <option value="0">Выбрать регион</option>
                            @if(!empty($Regions))
                                @foreach($Regions as $Region)
                                    <option value="{{$Region->id}}" @if(!empty($Item)&&$Region->id==$Item->parent_region_id) selected @endif>{{$Region->name}}</option>
                                @endforeach
                            @endif
                        </select>

                    </div>
                    <div class="col-md-6">
                        <label>&nbsp;</label>
                        <select class="form-control" name="advert[city]">
                            <option>Выбрать город</option>
                            @if(!empty($Citys))
                                @foreach($Citys as $City)
                                    <option value="{{$City->id}}" @if(!empty($Item)&&$City->id==$Item->region_id) selected @endif>{{$City->name}}</option>
                                @endforeach
                            @endif
                        </select>

                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="adv-form-title">Название услуги</label>
                        <input @if(!empty($Item->name))value="{{$Item->name}}"@endif type="text" class="form-control" id="adv-form-title" name="advert[title]"/>

                    </div>

                </div>

                <div class="form-group row">
                <div class="col-md-12">
                    <label for="adv-form-category">Выберите категорию</label>
                    <select class="form-control" id="adv-form-category" name="advert[category]">
                        <option>Выбрать категорию</option>
                        @if(!empty($Categories))
                            @foreach($Categories as $Category)
                                <option value="{{$Category->id}}" @if(!empty($Item)&&$Category->id==$Item->category) selected @endif>{{$Category->name}}</option>
                            @endforeach
                        @endif
                    </select>

                </div>

        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <select class="form-control" name="advert[subcategory]" @if(!empty($Item)&&!$Item->sub_category) style="display: none;" @endif>
                    <option value="0">Выбрать подкатегорию</option>
                    @if(!empty($subCategories))
                        @foreach($subCategories as $sCategory)
                            <option value="{{$sCategory->id}}" @if(!empty($Item)&&$sCategory->id==$Item->sub_category) selected @endif>{{$sCategory->name}}</option>
                        @endforeach
                    @endif
                </select>

            </div>

        </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="adv-form-description">Описание услуги</label>
                        <textarea class="form-control" id="adv-form-description" name="advert[description]">@if(!empty($Item->text)){{$Item->text}}@endif</textarea>


                    </div>

                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="advert-price-form">
                            <div class="advert-price-form-title">Стомость услуг / прайс лист</div>
                            <div class="advert-price-form-text">Оставьте пустым поле с ценой, для отображения “Договорная цена” или укажите<br/>конкретную стоимость услуги и ед. измерения</div>
                            <div class="advert-price-form-rows">

                                <div class="advert-price-form-row head">
                                    <div class="row-col-1">Наименование</div>
                                    <div class="row-col-2">Цена руб.</div>
                                    <div class="row-col-3">Ед. измерения</div>
                                </div>

                                <div class="advert-price-form-row d-none" >
                                    <div class="row-col-1"><input class="form-control" type="text" name="advert[price][name][]"/></div>
                                    <div class="row-col-2"><input class="form-control" type="text" name="advert[price][price][]"/></div>
                                    <div class="row-col-3"><select class="form-control" name="advert[price][measure][]">
                                            @if(!empty($MasureList))
                                                @foreach($MasureList as $Key=>$Masure)
                                                    <option value="{{$Key}}">{{$Masure}}</option>
                                                @endforeach
                                            @endif
                                        </select></div>
                                </div>

                                @if(!empty($AdvertData))

                                    @foreach($AdvertData->pricecs as $Price)

                                        <div class="advert-price-form-row">
                                            <div class="row-col-1"><input class="form-control" type="text" name="advert[price][name][]" value="{{$Price->name}}"/></div>
                                            <div class="row-col-2"><input class="form-control" type="text" name="advert[price][price][]" value="{{$Price->price}}"/></div>
                                            <div class="row-col-3"><select class="form-control" name="advert[price][measure][]">
                                                    @if(!empty($MasureList))
                                                        @foreach($MasureList as $Key=>$Masure)
                                                            <option @if($Price->masure==$Key) selected @endif value="{{$Key}}">{{$Masure}}</option>
                                                        @endforeach
                                                    @endif
                                                </select></div>
                                        </div>
                                    @endforeach

                                @endif

                                <div class="advert-price-form-row">
                                    <div class="row-col-1"><input class="form-control" type="text" name="advert[price][name][]"/></div>
                                    <div class="row-col-2"><input class="form-control" type="text" name="advert[price][price][]"/></div>
                                    <div class="row-col-3"><select class="form-control" name="advert[price][measure][]">
                                            @if(!empty($MasureList))
                                                @foreach($MasureList as $Key=>$Masure)
                                                    <option value="{{$Key}}">{{$Masure}}</option>
                                                @endforeach
                                            @endif
                                        </select></div>
                                </div>

                            </div>

                            <button id=""  type="button" class="btn btn-link">Добавить строку</button>
                        </div>
                    </div>

                </div>


                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="adv-form-images">Фото примеров ваших работ</label>
                        {{--   <input type="file" multiple class="form-control" id="adv-form-description" name="advert[images][]"/>
--}}


                        <div id="file-upload-form" class="uploader">


                            <input id="file-upload" class="file-upload-preview" multiple="" accept="image/*" type="file"
                                   name="advert[images][]">

                            <label for="file-upload" id="file-images">

                                @if(!empty($AdvertData))






                                    <div class="images-preview-inner">



                                        @foreach($AdvertData->images_all as $Image)
                                            <div class='inner-image-upload'><i></i><img src='{{ asset("storage/".$Image->path) }}'/></div>

                                        @endforeach



                                    </div>
                                @else
                                    <div class="images-preview-inner"></div>
                                @endif
                                <div id="start">
                                    <div>До 10 фото. Форматы jpg, gif, png. Размер одного фото
                                        до 10МБ.
                                    </div>
                                </div>


                            </label>
                        </div>


                    </div>

                </div>





                {{--<div class="form-group row" id="user-profile-edit">

                    <div class="col-md-12">
                        <div class="alert alert-warning text-black-50" role="alert">
                            <p>Профиль пользователя</p>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Контактное лицо</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->name}}"
                                           name="advert[user_name]" disabled/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>E-mail адрес</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->email}}"
                                           name="advert[user_email]" disabled/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Телефон</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->phone}}"
                                           name="advert[user_phone]" disabled/>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>--}}

                <div class="form-group row">
                    <div class="col-md-12 advert-edit-form-accept">
                        <label for="adv-form-accept">Я соглашаюсь с правилами использования сервиса, а также с передачей и обработкой моих данных в usl.com. Я подтверждаю своё совершеннолетие и ответственность за размещение объявления *</label>
                    </div>
                </div>


                <div class="form-validation-errors"></div>

                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-secondary">
                            Сохранить услугу
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
