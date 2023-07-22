@extends('layouts.app',['hideHeaderItems' => '1'])

@section('content')
    <section>
        <div class="container">
                    <div class="auth-form form-ui-style-default">
                        <form method="POST" action="{{ route('user.login') }}/"  name="form-login">
                            @csrf

                            <h1 class="form__title">@if(!empty($dataPageDefault->h1)){{$dataPageDefault->h1}}@else Вход на ТутУслуги @endif</h1>

                            <div class="form-group">
                                <label for="email" class="">Номер телефона <i class="requred">*</i></label>

                                <div>
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ old('email') }}"  autocomplete="phone" autofocus>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="password" class="">Пароль <i class="requred">*</i></label>
                                <div>
                                    <input id="password" type="password" class="form-control " name="password" autocomplete="current-password">
                                </div>
                            </div>



                            <div class="form-group">
                                <a href="{{ route('user.reset') }}/">Забыли пароль?</a>
                            </div>


                            <div class="form-validation-errors"></div>

                            <div class="form-group">
                                <div class="d-flex justify-content-between form__buttons align-items-center">
                                    <button type="submit" class="btn btn-primary">
                                        Вход на сайт
                                    </button>

                                    <a class="btn btn-link" href="{{ route('user.registration') }}/">
                                        Зарегистрироваться
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
        </div>
    </section>
@endsection
