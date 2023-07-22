@extends('layouts.admin')

@section('content')  <main class="main-page-inner">
    <h3 class="title-3 m-b-30">Регионы @if(!empty($Region))/ {{$Region->name}} @endif</h3>
    <div class="d-flex justify-content-end m-b-30">
        <a href="{{route('admin.region.edit',0)}}" class="btn btn-success btn-sm m-l-10">Добавить регион</a>
        <a href="{{route('admin.region.edit',0)}}?sub=1" class="btn btn-success btn-sm m-l-10">Добавить город</a>
    </div>

    <div class="table-responsive">
        <table class="table table-top-campaign">
            <thead>
            <tr>
                <th>Название региона</th>
                <th>Услуг</th>
                <th>Вкл</th>
                <th>Важный</th>
                <th>Футер</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($listItems as $Item)
                <tr>
                    <td><a class="link" href="{{route('admin.region.list.city',$Item->id)}}">{{$Item->name}}</a></td>
                    <td>{{$Item->GetAdvertsCountByRegion()}}</td>
                    <td>
                        <label class="switch switch-3d switch-success mr-3">
                            <input disabled type="checkbox" value="" name="" class="switch-input" @if(!empty($Item->public)&&$Item->public==1)checked="true"@endif>
                            <span class="switch-label"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </td>
                    <td>
                        <label class="switch switch-3d switch-success mr-3">
                            <input disabled type="checkbox" value="" name="" class="switch-input" @if(!empty($Item->favorite)&&$Item->favorite)checked="true"@endif>
                            <span class="switch-label"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </td>
                    <td>
                        <label class="switch switch-3d switch-success mr-3">
                            <input disabled type="checkbox" value="" name="" class="switch-input" @if(!empty($Item->footer)&&$Item->footer)checked="true"@endif>
                            <span class="switch-label"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </td>
                    <td>
                        <a class="link-edit" href="{{route('admin.region.edit',$Item->id)}}"><i class="fa fa-pencil"></i></a>
                        <a class="link-edit link-delete" href="{{route('admin.region.delete',$Item->id)}}"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>
    </div>
</main>
@endsection
