@extends('layouts.admin')

@section('content')  <main class="main-page-inner">
    <h3 class="title-3 m-b-30">Пользователи</h3>

    <form class="form-header m-b-15" action="{{route('admin.users.list')}}/" method="get">
        <input class="au-input au-input--xl" type="text" name="search" value="{{request()->get('search')}}" placeholder="поиск по id / email">
        <button class="au-btn--submit" type="submit">
            <i class="zmdi zmdi-search"></i>
        </button>
    </form>

    <div class="table-responsive">
        <table class="table table-top-campaign">
            <thead>
            <tr>
                <th>ID</th>
                <th>E-mail</th>
                <th>Имя</th>
                <th>Регистрация</th>
                <th>Был</th>
                <th class="text-right">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($listItems as $Item)
                <tr>
                    <td>{{$Item->id}}</td>
                    <td><a href="{{route('admin.users.edit',$Item->id)}}">{{$Item->email}}</a></td>
                    <td>{{$Item->name}}</td>
                    <td>{{$Item->created_at}}</td>
                    <td>{{$Item->last_login}}</td>

                    <td>
                        <a class="link-edit" href="{{route('admin.users.edit',$Item->id)}}"><i class="@if($Item->confirm_phone==1) active @endif fa fa-phone" aria-hidden="true"></i></a>

                        <a class="link-edit" href="{{route('admin.users.edit',$Item->id)}}"><i class="@if($Item->confirm_email==1) active @endif fa fa-envelope" aria-hidden="true"></i></a>
                        <a class="link-edit" href="{{route('admin.users.edit',$Item->id)}}"><label class="switch switch-3d switch-success mr-3">
                                <input disabled type="checkbox" value="" name="" class="switch-input" @if(!empty($Item->status)&&$Item->status)checked="true"@endif>
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label></a>




                        <a class="link-edit" href="{{route('admin.users.edit',$Item->id)}}"><i class="fa fa-pencil"></i></a>

                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>
        {{ $listItems->links('vendor.pagination.bootstrap-4') }}
    </div>
</main>
@endsection
