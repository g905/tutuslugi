@extends('layouts.admin')

@section('content')  <main class="main-page-inner">
    <h3 class="title-3 m-b-30">Категории</h3>
    <div class="d-flex justify-content-end m-b-30">
        <a href="{{route('admin.category.edit',0)}}" class="btn btn-success btn-sm m-l-10">Добавить категорию</a>
        <a href="{{route('admin.category.edit',0)}}?sub=1" class="btn btn-success btn-sm m-l-10">Добавить подкатегорию</a>
        <a href="{{route('admin.category.edit',0)}}?sub=2" class="btn btn-success btn-sm m-l-10">Добавить услугу</a>
    </div>

    <div class="table-responsive">
        <table class="table table-top-campaign">
            <thead>
                <tr>
                    <th>Название категории</th>
                    <th>Услуг</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($listItems as $Item)
            <tr>
                <td><a class="link" href="{{route('admin.category.edit',$Item->id)}}">{{$Item->name}}</a></td>
                <td>{{$Item->adverts_count}}</td>
                <td>
                    <a class="link-edit" href="{{route('admin.category.edit',$Item->id)}}"><i class="fa fa-pencil"></i></a>
                    <a class="link-edit link-delete" href="{{route('admin.category.delete',$Item->id)}}"><i class="fa fa-trash-o"></i></a>
                   </td>
            </tr>
                @if($Item->children)
                    @foreach($Item->children as $sItem)
                        <tr class="s-item">
                            <td><span class="s-item"></span><a class="link" href="{{route('admin.category.edit',$sItem->id)}}">{{$sItem->name}}</a></td>
                            <td>{{$sItem->adverts_count}}</td>
                            <td> <a class="link-edit" href="{{route('admin.category.edit',$sItem->id)}}"><i class="fa fa-pencil"></i></a>
                                <a class="link-edit link-delete" href="{{route('admin.category.delete',$sItem->id)}}"><i class="fa fa-trash-o"></i></a></td>
                        </tr>

                        @if($sItem->children)
                            @foreach($sItem->children as $ssItem)
                                <tr class="s-item">
                                    <td><span class="s-item-sub"></span><a class="link" href="{{route('admin.category.edit',$ssItem->id)}}">{{$ssItem->name}}</a></td>
                                    <td>{{$ssItem->adverts_count}}</td>
                                    <td> <a class="link-edit" href="{{route('admin.category.edit',$ssItem->id)}}"><i class="fa fa-pencil"></i></a>
                                        <a class="link-edit link-delete" href="{{route('admin.category.delete',$ssItem->id)}}"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                            @endforeach
                        @endif


                    @endforeach
                @endif
                @endforeach

            </tbody>
        </table>
    </div>
</main>
@endsection
