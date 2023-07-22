@extends('layouts.admin')
@section('content')
    <main class="main-page-inner">
        <h3 class="title-3 m-b-30">Посадочные страницы</h3>

        <form class="form-header m-b-15" action="{{route('admin.seopages.list')}}/" name="admin-seopages-list-form" method="get">
            <input type="hidden" name="ajax" value="1"/>
            <div class="row">
                <div class="col-3">
                    <select class="form-control" name="search_category">
                        <option value="0">Категория</option>
                        @if($CategoryList)
                            @foreach($CategoryList as $Category)
                                <option @if($Category->id==request()->get('search_category')) selected @endif value="{{$Category->id}}">{{$Category->name}}</option>
                                @if(!empty($Category['children']))
                                    @foreach($Category['children'] as $sCat)
                                        <option value="{{$sCat->id}}"
                                                @if($sCat->id==request()->get('search_category')) selected @endif>&nbsp;&nbsp;{{$sCat->name}}</option>
                                    @endforeach
                                @endif


                            @endforeach
                        @endif
                    </select>
                </div>



                <div class="col-7 d-flex">
                    <input class="form-control" type="text" name="search_text" value="{{request()->get('search_text')}}"
                           placeholder="поиск по подборкам">
                    <button class="au-btn--submit" type="submit">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </div>
                <div class="col-2 text-right">
                    <a href="{{route('admin.seopages.edit',0)}}" class="btn btn-success">Добавить посадочную</a>
                </div>

            </div>


        </form>

        <div class="table-responsive">
            <table class="table table-top-campaign">
                <thead>
                <tr>

                    <th>ID</th>
                    <th>поисковый запрос / h1</th>
                    <th>метатеги</th>

                    <th>вкл</th>
                    <th>поп.</th>
                    <th style="width: 100px;">см. ещё</th>
                    <th style="width: 100px;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($listItems as $Item)
                    <tr>

                        <td>{{$Item->id}}</td>
                        <td>
                            <a  href="{{route('admin.seopages.edit',$Item->id)}}">{{$Item->name}}<br/><br/>{{$Item->seo_query}}</a>
                            <br/>
                            <small>{{$Item->category_name}} / {{$Item->subcategory_name}}</small>
                        </td>
                        <td>
                            H1: {{$Item->h1}}<br/>
                            Т: {{$Item->title}}<br/>
                            Д: {{$Item->description}}<br/>
                        </td>


                        <td><label class="switch switch-3d switch-success mr-3">
                                <input disabled type="checkbox" value="" name="" class="switch-input" @if(!empty($Item->public)&&$Item->public)checked="true"@endif>
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label></td>
                        <td><label class="switch switch-3d switch-success mr-3">
                                <input disabled type="checkbox" value="" name="" class="switch-input" @if(!empty($Item->popular_adv)&&$Item->popular_adv)checked="true"@endif>
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label></td>
                        <td><label class="switch switch-3d switch-success mr-3">
                                <input disabled type="checkbox" value="" name="" class="switch-input" @if(!empty($Item->block_adv)&&$Item->block_adv)checked="true"@endif>
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label></td>


                       <td>


                         {{--   <a class="link-edit" href="{{route('admin.seopages.reload',$Item->id)}}"><i class="fa fa-refresh"></i></a>--}}

                            <a class="link-edit" href="{{route('admin.seopages.edit',$Item->id)}}"><i
                                    class="fa fa-pencil"></i></a>



                            <a class="link-edit link-delete" href="{{route('admin.seopages.delete',$Item->id)}}"><i
                                    class="fa fa-trash-o"></i></a>

                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            {{ $listItems->links('vendor.pagination.bootstrap-4') }}
        </div>
    </main>
@endsection



