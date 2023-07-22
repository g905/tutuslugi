@extends('layouts.admin')

@section('content')
    <main class="main-page-inner col-8 p-0">
        @if($Item)
            <form id="form-delete" name="form-delete" action="{{route('admin.seopages.delete',$Item->id)}}/" method="post" class="form-horizontal">
                @csrf
            </form>
        @endif
        <form action="{{route('admin.seopages.save')}}/" method="post" class="form-horizontal">
            <div class="card">
                <div class="card-header">
                    @if($Item)
                        Редактировать посадочную страницу {{$Item->name}}
                    @else
                        Добавить посадочную страницу
                    @endif
                </div>
                <div class="card-body card-block">
                    @csrf
                    @if(!empty($Item->id))
                        <input type="hidden" name="item_id" value="{{$Item->id}}"/>
                    @endif


                    <div class="form-group">
                        <label class="form-control-label">Поисковый запрос</label>
                        <input type="text" class="form-control" name="seo_query" @if(!empty($Item->seo_query))value="{{$Item->seo_query}}"@endif>
                    </div>


                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="adv-form-category">Выберите категорию</label>
                            <select class="form-control" id="adv-form-category" name="category">
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
                            <select class="form-control" name="subcategory">
                                <option  value="0">Выбрать подкатегорию</option>
                                @if(!empty($subCategories))
                                    @foreach($subCategories as $sCategory)
                                        <option value="{{$sCategory->id}}" @if(!empty($Item)&&$sCategory->id==$Item->subcategory) selected @endif>{{$sCategory->name}}</option>
                                    @endforeach
                                @endif
                            </select>

                        </div>

                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Посадочный URL</label>
                        <input type="text" class="form-control" name="url" @if(!empty($Item->url))value="{{$Item->url}}"@endif>
                    </div>



                    <div class="card-header">
                        SEO настройки посадочной
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Название ссылки</label>
                        <input type="text" class="form-control" name="name" @if(!empty($Item->name))value="{{$Item->name}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Title</label>
                        <input type="text" class="form-control" name="title" @if(!empty($Item->title))value="{{$Item->title}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Description</label>
                        <input type="text" class="form-control" name="description" @if(!empty($Item->description))value="{{$Item->description}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">H1</label>
                        <input type="text" class="form-control" name="h1" @if(!empty($Item->h1))value="{{$Item->h1}}"@endif>
                    </div>


                    <div class="form-group">
                        <label class="form-control-label">Описание категории / SEO-текст</label>
                        <textarea  class="form-control" name="text">@if(!empty($Item->text)){{$Item->text}}@endif</textarea>
                    </div>


                    <div class="form-group">
                        <label class="form-control-label">Мастер (1)</label>
                        <input type="text" class="form-control" name="master_1" @if(!empty($Item->master_1))value="{{$Item->master_1}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Мастера (2,3,4)</label>
                        <input type="text" class="form-control" name="master_2" @if(!empty($Item->master_2))value="{{$Item->master_2}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Мастеров (5,6,7,8,9,0)</label>
                        <input type="text" class="form-control" name="master_3" @if(!empty($Item->master_3))value="{{$Item->master_3}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="switch switch-3d switch-success mr-3">
                            <input type="checkbox" value="1" name="name_adv" class="switch-input" @if(!empty($Item->name_adv)&&$Item->name_adv)checked="true"@endif>
                            <span class="switch-label"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <label class="form-control-label">Имя в названии объявления</label>
                    </div>


                    <div class="form-group">
                        <label class="switch switch-3d switch-success mr-3">
                            <input type="checkbox" value="1" name="popular_adv" class="switch-input" @if(!empty($Item->popular_adv)&&$Item->popular_adv)checked="true"@endif>
                            <span class="switch-label"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <label class="form-control-label">Популярная услуга</label>
                    </div>

                    <div class="form-group">
                        <label class="switch switch-3d switch-success mr-3">
                            <input type="checkbox" value="1" name="block_adv" class="switch-input" @if(!empty($Item->block_adv)&&$Item->block_adv)checked="true"@endif>
                            <span class="switch-label"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <label class="form-control-label">Смотрите также (боковая колонка)</label>
                    </div>


                    <div class="form-group">
                        <label class="switch switch-3d switch-success mr-3">
                            <input type="checkbox" value="1" name="public" class="switch-input" @if(!empty($Item->public)&&$Item->public)checked="true"@endif>
                            <span class="switch-label"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <label class="form-control-label">Включен/выключен</label>
                    </div>

                    <div class="form-group">
                        <label class="switch switch-3d switch-success mr-3">
                            <input type="checkbox" value="1" name="show_short_description" class="switch-input" @if(!empty($Item->show_short_description)&&$Item->show_short_description)checked="true"@endif>
                            <span class="switch-label"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <label class="form-control-label"> Отображать короткий текст</label>
                    </div>




                    <div class="text-black">
                        {category} {category.parent} {total.u} {totalu.textu} {totalu.textp} {totalu.texto} {city} {city.in} {region} {region.in} {master.text} {total.m}
                    </div>

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
