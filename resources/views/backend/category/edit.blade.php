@extends('layouts.admin')

@section('content')
    <main class="main-page-inner col-8 p-0">
        @if($Item)
            <form id="form-delete" name="form-delete" action="{{route('admin.category.delete',$Item->id)}}/"
                  method="post" class="form-horizontal">
                @csrf
            </form>
        @endif
        <form action="{{route('admin.category.save')}}/" method="post" class="form-horizontal">
            <div class="card">
                <div class="card-header">
                    @if($isService>0)
                        @if($Item)
                            Редактирование услуги {{$Item->name}}
                        @else
                            Добавление услуги
                        @endif
                    @else
                        @if($Item)
                            Редактирование категории {{$Item->name}}
                        @else
                            Добавление категории
                        @endif
                    @endif
                </div>
                <div class="card-body card-block">
                    @csrf
                    @if(!empty($Item->id))
                        <input type="hidden" name="item_id" value="{{$Item->id}}"/>
                    @endif

                    @if($isService==0)
                        <input type="hidden" name="this_service" value="0">
                        @if((request()->get('sub')==1 OR (!empty($Item->parent_id) && $Item->parent_id>0)) AND ($isService==0) )
                            <div class="form-group">
                                <label class="form-control-label">Основная категория</label>
                                <select class="form-control" name="parent_id">
                                    @if($CategoryList)
                                        @foreach($CategoryList as $Category)
                                            <option value="{{$Category->id}}"
                                                    @if(!empty($Item->parent_id)&&$Category->id==$Item->parent_id) selected @endif>{{$Category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="parent_id" value="0"/>
                        @endif
                    @endif


                    @if($isService>0)
                        <input type="hidden" name="this_service" value="1">
                        <div class="form-group">
                            <label class="form-control-label">Категория услуги</label>
                            <select class="form-control" name="parent_id">
                                @if($CategoryList)
                                    @foreach($CategoryList as $Category)
                                        <option disabled value="{{$Category->id}}"
                                                @if(!empty($Item->parent_id)&&$Category->id==$Item->parent_id) selected @endif>{{$Category->name}}</option>

                                        @if($Category->items)
                                            @foreach($Category->items as $sCategory)
                                                <option value="{{$sCategory->id}}"
                                                        @if(!empty($Item->parent_id)&&$sCategory->id==$Item->parent_id) selected @endif>
                                                    ---{{$sCategory->name}}</option>
                                            @endforeach
                                        @endif

                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Настройка цены</label>
                            <select class="form-control" name="measure">
                                @if($MeasureList)
                                    @foreach($MeasureList as $key=>$Measure)
                                        <option value="{{$key}}"
                                                @if(!empty($Item->measure)&&$key==$Item->measure) selected @endif>{{$Measure}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>


                    @endif


                    <div class="form-group">
                        <label class="form-control-label">Название  @if($isService==0)категории @else услуги @endif</label>
                        <input type="text" class="form-control" name="name"
                               @if(!empty($Item->name))value="{{$Item->name}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">URL</label>
                        <input type="text" class="form-control" name="url"
                               @if(!empty($Item->url))value="{{$Item->url}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">URL иконки</label>
                        <input type="text" class="form-control" name="icon"
                               @if(!empty($Item->icon))value="{{$Item->icon}}"@endif>
                    </div>

                    <div class="card-header">
                        SEO настройки категории
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Title</label>
                        <input type="text" class="form-control" name="title"
                               @if(!empty($Item->title))value="{{$Item->title}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Description</label>
                        <input type="text" class="form-control" name="description"
                               @if(!empty($Item->description))value="{{$Item->description}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">H1</label>
                        <input type="text" class="form-control" name="h1"
                               @if(!empty($Item->h1))value="{{$Item->h1}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Хлебные крошки</label>
                        <input type="text" class="form-control" name="name_bread"
                               @if(!empty($Item->name_bread))value="{{$Item->name_bread}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Описание категории / SEO-текст</label>
                        <textarea class="form-control"
                                  name="text">@if(!empty($Item->text)){{$Item->text}}@endif</textarea>
                    </div>


                    <div class="form-group">
                        <label class="form-control-label">Мастер (1)</label>
                        <input type="text" class="form-control" name="master_1"
                               @if(!empty($Item->master_1))value="{{$Item->master_1}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Мастера (2,3,4)</label>
                        <input type="text" class="form-control" name="master_2"
                               @if(!empty($Item->master_2))value="{{$Item->master_2}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Мастеров (5,6,7,8,9,0)</label>
                        <input type="text" class="form-control" name="master_3"
                               @if(!empty($Item->master_3))value="{{$Item->master_3}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="switch switch-3d switch-success mr-3">
                            <input type="checkbox" value="1" name="name_adv" class="switch-input"
                                   @if(!empty($Item->name_adv)&&$Item->name_adv)checked="true"@endif>
                            <span class="switch-label"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <label class="form-control-label">Имя в названии объявления</label>
                    </div>

                    <div class="form-group">
                        <label class="switch switch-3d switch-success mr-3">
                            <input type="checkbox" value="1" name="footer" class="switch-input"
                                   @if(!empty($Item->footer)&&$Item->footer)checked="true"@endif>
                            <span class="switch-label"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <label class="form-control-label"> Отображать в футере</label>
                    </div>

                    <div class="form-group">
                        <label class="switch switch-3d switch-success mr-3">
                            <input type="checkbox" value="1" name="favorite" class="switch-input"
                                   @if(!empty($Item->favorite)&&$Item->favorite)checked="true"@endif>
                            <span class="switch-label"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <label class="form-control-label"> Важная категория</label>
                    </div>

                    <div class="form-group">
                        <label class="switch switch-3d switch-success mr-3">
                            <input type="checkbox" value="1" name="show_short_description" class="switch-input"
                                   @if(!empty($Item->show_short_description)&&$Item->show_short_description)checked="true"@endif>
                            <span class="switch-label"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <label class="form-control-label"> Отображать короткий текст</label>
                    </div>

                    @if($isService>0)
                        <div class="form-group">
                            <label class="switch switch-3d switch-success mr-3">
                                <input type="checkbox" value="1" name="popular" class="switch-input"
                                       @if(!empty($Item->popular)&&$Item->popular)checked="true"@endif>
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                            <label class="form-control-label"> Популярная услуга</label>
                        </div>
                        <div class="form-group">
                            <label class="switch switch-3d switch-success mr-3">
                                <input type="checkbox" value="1" name="show_col" class="switch-input"
                                       @if(!empty($Item->show_col)&&$Item->show_col)checked="true"@endif>
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                            <label class="form-control-label"> Смотрите также (боковая колонка)</label>
                        </div>
                    @else
                        <input type="hidden" name="show_col" value="0">
                        <input type="hidden" name="popular" value="0">
                    @endif


                    <div class="text-black">
                        {category} {category.parent} {total.u} {totalu.textu} {totalu.textp} {totalu.texto} {city}
                        {city.in} {region} {region.in} {master.text} {total.m}
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
