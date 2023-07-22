@extends('layouts.admin')

@section('content')
    <main class="main-page-inner col-8 p-0">


        @if($Item)
            <form id="form-delete" name="form-delete" action="{{route('admin.users.delete',$Item->id)}}/" method="post" class="form-horizontal">
                @csrf
            </form>
        @endif

        <form action="{{route('admin.users.save')}}/" method="post" class="form-horizontal">
            <div class="card">
                <div class="card-header">Пользователи / Редактирование пользователя</div>
                <div class="card-body card-block">
                    @csrf
                    @if(!empty($Item->id))
                        <input type="hidden" name="item_id" value="{{$Item->id}}"/>
                    @endif





                    <div class="form-group">
                        <label class="form-control-label">Полное имя</label>
                        <input type="text" class="form-control" name="name" @if(!empty($Item->name))value="{{$Item->name}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">E-mail @if($Item->confirm_email==1) <small class="text-success">подтвержден</small> @else <small class="text-danger">не подтвержден</small> @endif</label>
                        <input type="text" class="form-control" name="email" @if(!empty($Item->email))value="{{$Item->email}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Телефон @if($Item->confirm_phone==1) <small class="text-success">подтвержден</small> @else <small class="text-danger">не подтвержден</small> @endif</label>
                        <input type="text" class="form-control" name="phone" @if(!empty($Item->phone))value="{{$Item->phone}}"@endif>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Аватар</label>
                        <input type="file" id="file-input" name="file-input" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <div>
                            <label class="form-control-label">Email -  @if($Item->confirm_email==1) <small class="text-success">подтвержден</small> @else <small class="text-danger">не подтвержден</small> @endif</label>
                        </div>

                        <div>
                            <label class="form-control-label">Телефон -  @if($Item->confirm_phone==1) <small class="text-success">подтвержден</small> @else <small class="text-danger">не подтвержден</small> @endif</label>
                        </div>
                        <div>
                            <label class="form-control-label">Регистрация {{$Item->created_at}}</label>
                        </div>
                        <div>
                            <label class="form-control-label">Авторизация {{$Item->last_login}}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">
                            <a class="d-flex align-items-center" href=""><img class="m-r-5" src="/backend/images/new-tab.svg"/> Объявлений
                            <span class="counter">0</span>
                            </a>
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">
                            <a class="d-flex align-items-center" href=""><img class="m-r-5" src="/backend/images/new-tab.svg"/> Отзывы
                            <span class="counter">0</span>
                            </a>
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">
                            <a class="d-flex align-items-center" href=""><img class="m-r-5" src="/backend/images/new-tab.svg"/> Баланс
                            <span class="counter">0</span>
                            </a>
                        </label>
                    </div>





                    <div class="form-group">
                        <label class="switch switch-3d switch-success mr-3">
                            <input type="checkbox" value="1" name="status" class="switch-input" @if(!empty($Item->status)&&$Item->status)checked="true"@endif>
                            <span class="switch-label"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <label class="form-control-label">Активный</label>
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
