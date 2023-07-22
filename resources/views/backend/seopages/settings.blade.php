@extends('layouts.admin')

@section('content')
    <main class="main-page-inner col-8 p-0">


            <div class="card">
                <div class="card-header">
                   Настройки сайта
                </div>
                <div class="card-body card-block">
                    @if(!empty($Items))
                        @foreach($Items as $Item)

                            @if($Item->page_type=='header_text')

                                <form action="{{route('admin.seo.save')}}/" method="post" class="form-horizontal">
                                    @csrf
                                    @if(!empty($Item->id))
                                        <input type="hidden" name="item_id" value="{{$Item->id}}"/>
                                    @endif
                                    <div class="form-group"><h3>{{$Item->name}}</h3></div>

                                    <div class="form-group" style="display: none">
                                        <label class="form-control-label">Тайтл</label>
                                        <input type="text" class="form-control" name="title" @if(!empty($Item->title))value="{{$Item->title}}"@endif>
                                    </div>

                                    <div class="form-group" style="display: none">
                                        <label class="form-control-label">H1</label>
                                        <input type="text" class="form-control" name="h1" @if(!empty($Item->h1))value="{{$Item->h1}}"@endif>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label">Ссылка</label>
                                        <input type="text" class="form-control" name="description" @if(!empty($Item->description))value="{{$Item->description}}"@endif>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label">Текст уведомления</label>
                                        <textarea  class="form-control" name="text">@if(!empty($Item->text)){{$Item->text}}@endif</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-success">Сохранить
                                    </button>

                                </form>
                                <div class="form-group"><br/><hr/><br/></div>

                            @else



                            <form action="{{route('admin.seo.save')}}/" method="post" class="form-horizontal">
                                @csrf
                                @if(!empty($Item->id))
                                    <input type="hidden" name="item_id" value="{{$Item->id}}"/>
                                @endif
                                <div class="form-group"><h3>{{$Item->name}}</h3></div>

                                <div class="form-group">
                                    <label class="form-control-label">Тайтл</label>
                                    <input type="text" class="form-control" name="title" @if(!empty($Item->title))value="{{$Item->title}}"@endif>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">H1</label>
                                    <input type="text" class="form-control" name="h1" @if(!empty($Item->h1))value="{{$Item->h1}}"@endif>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Дискрипшен</label>
                                    <input type="text" class="form-control" name="description" @if(!empty($Item->description))value="{{$Item->description}}"@endif>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Описание категории / SEO-текст</label>
                                    <textarea  class="form-control" name="text">@if(!empty($Item->text)){{$Item->text}}@endif</textarea>
                                </div>

                                <button type="submit" class="btn btn-success">Сохранить
                                </button>

                            </form>
                            <div class="form-group"><br/><hr/><br/></div>
                            @endif



                        @endforeach
                    @endif



                        @if(!empty($Banners))
                            <form action="{{route('admin.banners.save')}}/" method="post" class="form-horizontal">
                                @csrf
                        @foreach($Banners as $Banner)




                                <div class="form-group"><h3>{{$Banner->name}}</h3></div>

                                <div class="form-group">
                                    <label class="form-control-label">Ссылка на переход</label>
                                    <input type="text" class="form-control" name="link[{{$Banner->id}}]" @if(!empty($Banner->link))value="{{$Banner->link}}"@endif>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Ссылка на баннер</label>
                                    <input type="text" class="form-control" name="path[{{$Banner->id}}]" @if(!empty($Banner->path))value="{{$Banner->path}}"@endif>
                                </div>








                        @endforeach
                                <button type="submit" class="btn btn-success">Сохранить
                                </button>

                            </form>
                            <div class="form-group"><br/><hr/><br/></div>
                    @endif











                </div>

            </div>

    </main>
@endsection
