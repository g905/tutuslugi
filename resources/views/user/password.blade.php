@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="page-col-inner">
            <div class="page-col-left s-300">
                @include("user.menu")

            </div>
            <div class="page-col-right s-910">
                <div class="page__section_title_one">Сменить пароль</div>

                <div class="advert-edit-form user-edit-form">
                    <form method="POST" action="{{ route('user.password') }}/"  name="form-user-password">
                        @csrf






                        <div class="form-group ">
                            <label for="password" >Старый пароль</label>

                            <div >
                                <input id="password" type="password" class="form-control" name="password-old"  autocomplete="new-password">


                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="password" >Новый пароль</label>

                            <div >
                                <input id="password" type="password" class="form-control" name="password"  autocomplete="new-password">


                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="password-confirm" >Повторите новый пароль</label>

                            <div >
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>


                        <div class="form-validation-errors">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <div class="">

                                            {{ $error }}


                                        </div>@endforeach
                                </div>
                            @endif


                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-secondary">
                                    Сохранить
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
