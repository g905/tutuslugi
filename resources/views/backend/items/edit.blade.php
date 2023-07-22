@extends('layouts.admin')

@section('content')
    <main class="main-page-inner col-8 p-0">

        @if($Item)
            <form id="form-delete" name="form-delete" action="{{route('admin.items.delete',$Item->id)}}/" method="post" class="form-horizontal">
                @csrf
            </form>
        @endif
        <form action="{{route('admin.items.save')}}/" method="post" class="form-horizontal ajax-form-send" >
            <div class="card">
                <div class="card-header">
                    @if($Item)
                        Редактирование объявления t-{{$Item->id}}
                    @else
                        Добавление объявления
                    @endif
                </div>
                <div class="card-body card-block">
                    @csrf
                    @if(!empty($Item->id))
                        <input type="hidden" name="item_id" value="{{$Item->id}}"/>
                    @endif


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
                            <select class="form-control"  name="advert[city]">
                                <option value="0">Выбрать город</option>
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
                                <option value="0">Выбрать категорию</option>
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
                            <select class="form-control" name="advert[subcategory]">
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


                    <div class="form-group row">

                        <div class="col-md-12">
                            <div class="alert alert-warning" role="alert">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label>Пользователь</label>
                                            <input type="text" class="form-control" @if(!empty($Item))value="{{$Item->user_name}}"@endif name="advert[user_name]"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label>Телефон</label>
                                            <input type="text" class="form-control phone-mask" @if(!empty($Item))value="{{$Item->phone_clear}}"@endif name="advert[phone]" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label>id пользователя</label>
                                            <input type="text" class="form-control" @if(!empty($Item))value="{{$Item->user_id}}"@endif name="advert[user_id]" />
                                        </div>
                                    </div>
                                @if(!empty($User))<div class="form-group row">
                                        <div class="col-md-12">
                                           Пользователь: <a href="{{route("admin.users.edit",$User->id)}}">{{$User->email}}</a>
                                        </div>
                                    </div>@endif

                                @if(!empty($Item))
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                           Статус: {{$Item->status_text}}
                                        </div>
                                    </div>

                                  {{--  <div class="form-group row">
                                        <div class="col-md-12">
                                            Период публикации: {{$AdvertData->date_start_format_short}} - {{$Item->date_end}}
                                        </div>
                                    </div>--}}

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                                @if($Item->status==1)
                                                <button type="button" data-modal-status-2="{{$Item->id}}" class="btn btn-light btn-sm">Опубликовать</button>
                                                <button type="button" data-modal-status-3="{{$Item->id}}" class="btn btn-light btn-sm">Заблокировать</button>
                                                @endif
                                                @if($Item->status==2)
                                                <button type="button" data-modal-status-1="{{$Item->id}}" class="btn btn-light btn-sm">Снять с публикации</button>
                                                <button type="button" data-modal-status-3="{{$Item->id}}" class="btn btn-light btn-sm">Заблокировать</button>
                                                @endif
                                                @if($Item->status==3)
                                                <button type="button" data-modal-status-2="{{$Item->id}}" class="btn btn-light btn-sm">Опубликовать</button>
                                                <button type="button" data-modal-status-2="{{$Item->id}}" class="btn btn-light btn-sm">Разблокировать</button>
                                                @endif


                                        </div>
                                    </div>
                                    @endif


                            </div>

                        </div>
                    </div>

                    <div class="form-validation-errors"></div>
                </div>


                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Сохранить
                    </button>
                    <button type="submit" form="form-delete" class="btn btn-danger m-l-15">
                        Удалить
                    </button>
                </div>
            </div>
        </form>
    </main>
@endsection
