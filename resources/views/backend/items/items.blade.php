<main class="main-page-inner">
    <h3 class="title-3 m-b-30">Услуги</h3>

    <form class="form-header m-b-15" action="{{route('admin.items.list')}}/" name="admin-items-list-form" method="get">
        <input type="hidden" name="ajax" value="1"/>
        <div class="row">
            <div class="col-2">
                <select class="form-control" name="search_category">
                    <option value="0">Категория</option>
                    @if($CategoryList)
                        @foreach($CategoryList as $Category)
                            <option value="{{$Category->id}}">{{$Category->name}}</option>
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
            <div class="col-2">
                <select class="form-control" name="search_city">
                    <option value="0">Город</option>
                    @if($RegionsList)
                        @foreach($RegionsList as $Region)
                            <option disabled value="{{$Region->id}}"
                                    style="font-weight: bold;">{{$Region->name}}</option>

                            @if($Region['citys'])
                                @foreach($Region['citys'] as $City)
                                    @if($City->adverts_count>0)
                                        <option @if($City->id==request()->get('search_city')) selected @endif value="{{$City->id}}">
                                            &nbsp;&nbsp;&nbsp;{{$City->name}}</option>
                                    @endif
                                @endforeach
                            @endif

                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-2">
                <select class="form-control" name="search_status">
                    <option value="0">Статус</option>
                    @if($StatusList)
                        @foreach($StatusList as $key=>$Status)
                            <option value="{{$key}}"
                                    @if($key==request()->get('search_status')) selected @endif>{{$Status}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="col-4 d-flex">
                <input class="form-control" type="text" name="search_text" value="{{request()->get('search_text')}}"
                       placeholder="Поиск ID / Заголовок / Телефон / Емейл пользователя / ID польз. ">
                <button class="au-btn--submit" type="submit">
                    <i class="zmdi zmdi-search"></i>
                </button>
            </div>
            <div class="col-2">
                <a href="{{route('admin.items.edit',0)}}" class="btn btn-success">Добавить объявление</a>
            </div>

        </div>


    </form>

    <div class="table-responsive">
        <table class="table table-top-campaign">
            <thead>
            <tr>
                <th style="width: 30px;">
                    &nbsp;

                    &nbsp;
                </th>
                <th>ID</th>
                <th>Название услуги</th>
                <th>Добавлено</th>
                <th>Статус</th>
                <th class="text-right">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($listItems as $Item)
                <tr>
                    <td>


                    </td>
                    <td>t-{{$Item->id}}</td>
                    <td><a class="get-item-modal" href="{{route('admin.items.get',$Item->id)}}">{{$Item->name}}</a>
                        <br/>
                        <small>{{$Item->category_data['name']}} @if(!empty($Item->subcategory_data) && $Item->subcategory_data['name'])/ {{$Item->subcategory_data['name']}} @endif
                            / {{$Item->region_data['name']}}</small>
                    </td>
                    <td>{{$Item->date_start}}</td>
                    <td>
                        <div class="rs-select2--trans rs-select2--sm">
                            <select autocomplete="off" data-items-status-change="{{$Item->id}}" class="js-select2" name="property">

                                @if($StatusList)
                                    @foreach($StatusList as $key=>$Status)
                                        <option value="{{$key}}"
                                                @if($key==$Item->status) selected @endif>{{$Status}}</option>
                                    @endforeach
                                @endif



                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                    </td>

                    <td>

                        <a class="link-edit" target="_blank" href="{{Config::get('app.url')}}{{$Item->region_data['url']}}/{{$Item->category_data['slug']}}/{{$Item->subcategory_data['slug']}}/t-{{$Item->id}}"><i
                                class="fa fa-external-link"></i></a>


                        <a class="link-edit" href="{{route('admin.items.edit',$Item->id)}}"><i
                                class="fa fa-pencil"></i></a>
                        @if($Item->user_id)
                        <a class="link-edit" href="{{route('admin.users.edit',$Item->user_id)}}"><i
                                class="fa fa-user"></i></a>
                        @endif

                        <a class="link-edit link-delete" href="{{route('admin.items.delete',$Item->id)}}"><i
                                class="fa fa-trash-o"></i></a>


                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>
        {{ $listItems->links('vendor.pagination.bootstrap-4') }}
    </div>
</main>
