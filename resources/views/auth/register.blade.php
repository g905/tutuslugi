@extends('layouts.app',['hideHeaderItems' => '1'])

@section('content')
    <section>
        <div class="container">
            <div class="auth-form form-ui-style-default">
                    <form method="POST" action="{{ route('user.registration') }}/"  name="form-registration">
                        @csrf


                        <div class="registration-form step-1">
                            <h1 class="form__title"> @if(!empty($dataPageDefault->h1)){{$dataPageDefault->h1}}@else Регистрация по эл. почте @endif</h1>
                            <div class="form-group">
                                <label for="name">ФИО <i class="requred">*</i></label>

                                <div>
                                    <input id="name" type="text" class="form-control " name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Номер телефона <i class="requred">*</i></label>

                                <div>
                                    <input id="phone" type="text" class="form-control " name="phone" value="{{ old('phone') }}"  autocomplete="phone">


                                </div>
                            </div>


                            <div class="form-group">
                                <label for="password">Пароль <i class="requred">*</i></label>

                                <div>
                                    <input id="password" type="password" class="form-control" name="password"  autocomplete="new-password">


                                </div>
                            </div>


                            <div class="form-group">
                                <label class="label-accept-text">
                                    Нажимая «Зарегистрироваться» вы подтверждаете согласие с условиями <a target="_blank" href="{{route('userterms')}}/">Пользовательского соглашения</a> и  <a target="_blank" href="{{route('userterms')}}/">Политикой обработки персональных данных</a>.
                                </label>


                            </div>

                            <div class="form-validation-errors"></div>

                            <div class="form-group">
                                <div class="d-flex justify-content-between form__buttons align-items-center">
                                    <button type="button" class="btn btn-primary pre-registration-send">
                                        Зарегистрироваться
                                    </button>

                                    <a class="btn btn-link" href="{{ route('user.login') }}">
                                        Вход
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="registration-form step-2 d-none">
                            <h1 class="form__title">Код подтверждения</h1>

                            <div class="form-group form-text-info">
                                Для подтверждения регистрации, на указанный Вами номер был отправлен звонок.<br/>
                                Кодом подтверждения являются последние 4 цифры позвонившего Вам номера.

                            </div>


                            <div class="form-group">
                                <label for="email">Код подтверждения <i class="requred">*</i></label>

                                <div>
                                    <input id="code" type="text" class="form-control " name="code" value="{{ old('code') }}"  autocomplete="code" placeholder="Последние 4 цифры позвонившего Вам номера">


                                </div>
                            </div>

                            <div class="form-group">
                                <a href="{{ route('user.reset') }}/" class="text-decoration-none form-registration-change-number">Изменить номер</a>
                            </div>

                            <div class="form-validation-errors"></div>
                            <div class="form-group">
                                <div class="d-flex justify-content-between form__buttons align-items-center">
                                    <button type="submit" class="btn btn-primary">
                                        Отправить
                                    </button>



                                </div>
                            </div>

                        </div>

                    </form>
            </div>
        </div>
    </section>
@endsection
