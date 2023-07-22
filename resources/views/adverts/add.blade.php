@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="advert-edit-form">
            <div class="page__user__title">Добавить услугу</div>
            <form method="POST" enctype="multipart/form-data" action="{{ route('advert.add') }}/" name="form-advert-add">
                @csrf

                <div class="form-group row">

                    <div class="col-md-12">
                        <div class="alert alert-warning" role="alert">
                            <p><small>Профиль пользователя</small></p>
                            @if(!Auth::user()->name OR !Auth::user()->phone)
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Имя</label>
                                        <input type="text" class="form-control" value="{{Auth::user()->name}}" name="advert[user_name]"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Телефон</label>
                                        <input type="text" class="form-control phone-mask" value="{{Auth::user()->phone}}" name="advert[user_phone]" />
                                    </div>
                                </div>

                            @else
                                <input type="hidden" class="form-control" value="{{Auth::user()->name}}" name="advert[user_name]"/>
                                <input type="hidden" class="form-control" value="{{Auth::user()->phone}}" name="advert[user_phone]" />
                                <p>Имя: {{Auth::user()->name}}</p>
                                <p>Телефон: {{Auth::user()->phone}} <a href="{{ route('user.settings') }}/" >Изменить</a></p>
                            @endif
                        </div>

                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="adv-form-location">Местоположение</label>
                        <select class="form-control" id="adv-form-location" name="advert[region]">
                            <option>Выбрать регион</option>
                            @if(!empty($Regions))
                                @foreach($Regions as $Region)
                                    <option value="{{$Region->id}}">{{$Region->name}}</option>
                                @endforeach
                            @endif
                        </select>

                    </div>
                    <div class="col-md-6">
                        <label>&nbsp;</label>
                        <select class="form-control" disabled name="advert[city]">
                            <option>Выбрать город</option>
                        </select>

                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="adv-form-title">Название услуги</label>
                        <input type="text" class="form-control" id="adv-form-title" name="advert[title]"/>

                    </div>

                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="adv-form-category">Выберите категорию</label>
                        <select class="form-control" id="adv-form-category" name="advert[category]">
                            <option>Выбрать категорию</option>
                            @if(!empty($Categories))
                                @foreach($Categories as $Category)
                                    <option value="{{$Category->id}}">{{$Category->name}}</option>
                                @endforeach
                            @endif
                        </select>

                    </div>

                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <select class="form-control" name="advert[subcategory]" disabled>
                            <option  value="0">Выбрать подкатегорию</option>
                        </select>

                    </div>

                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="adv-form-description">Описание услуги</label>
                        <textarea class="form-control" id="adv-form-description" name="advert[description]"></textarea>

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


                                <div class="images-preview-inner">
                                </div>

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
                            Добавить услугу
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
