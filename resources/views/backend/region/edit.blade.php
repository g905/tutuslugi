@extends('layouts.admin')

@section('content')
    <main class="main-page-inner col-8 p-0">
        @if($Item)
            <form id="form-delete" name="form-delete" action="{{route('admin.region.delete',$Item->id)}}/" method="post" class="form-horizontal">
                @csrf
            </form>
        @endif
        <form action="{{route('admin.region.save')}}/" method="post" class="form-horizontal">
            <div class="card">
                <div class="card-header">
                    @if($Item)
                        Редактирование региона {{$Item->name}}
                    @else
                        Добавление региона
                    @endif
                </div>
                <div class="card-body card-block">
                    @csrf
                    @if(!empty($Item->id))
                        <input type="hidden" name="item_id" value="{{$Item->id}}"/>
                    @endif

                    <div class="form-group">
                        <label class="form-control-label">Тип</label>
                        <select class="form-control" name="type">
                          <option value="1" @if(!empty($Item->type)&&$Item->type==1) selected @endif>Область</option>
                          <option value="2" @if(!empty($Item->type)&&$Item->type==2) selected @endif>Город</option>

                        </select>
                    </div>

                    @if(request()->get('sub')==1 OR (!empty($Item->parent_id) && $Item->parent_id>0))
                        <div class="form-group">
                            <label class="form-control-label">Добавлен в область {region}</label>
                            <select class="form-control" name="parent_id">
                                @if($RegionsList)
                                    @foreach($RegionsList as $Region)
                                        <option value="{{$Region->id}}" @if(!empty($Item->parent_id)&&$Region->id==$Item->parent_id) selected @endif>{{$Region->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @else
                        <input type="hidden" name="parent_id" value="0"/>
                    @endif

                    <div class="form-group">
                        <label class="form-control-label">Название {city}</label>
                        <input type="text" class="form-control" name="name" @if(!empty($Item->name))value="{{$Item->name}}"@endif>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Склонение, где {city.n}</label>
                        <input type="text" class="form-control" name="name_case" @if(!empty($Item->name_case))value="{{$Item->name_case}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">URL</label>
                        <input type="text" class="form-control" name="url" @if(!empty($Item->url))value="{{$Item->url}}"@endif>
                    </div>




                    <div class="form-group">
                        <label class="switch switch-3d switch-success mr-3">
                            <input type="checkbox" value="1" name="favorite" class="switch-input" @if(!empty($Item->favorite)&&$Item->favorite)checked="true"@endif>
                            <span class="switch-label"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <label class="form-control-label">Важный город (выделен жирным)</label>
                    </div>

                    <div class="form-group">
                        <label class="switch switch-3d switch-success mr-3">
                            <input type="checkbox" value="1" name="footer" class="switch-input" @if(!empty($Item->footer)&&$Item->footer)checked="true"@endif>
                            <span class="switch-label"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <label class="form-control-label">Выводить в футере сайта</label>
                    </div>

                    <div class="form-group">
                        <label class="switch switch-3d switch-success mr-3">
                            <input type="checkbox" value="1" name="public" class="switch-input" @if(!empty($Item->public)&&$Item->public)checked="true"@endif>
                            <span class="switch-label"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <label class="form-control-label">Включен/выключен</label>
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
