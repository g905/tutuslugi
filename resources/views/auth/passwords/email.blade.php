{{--
@extends('layouts.app-noheader')
@section('content')

                    <form method="POST" action="{{ route('user.reset') }}/" name="form-reset">
                        @csrf
                        <h1 class="form__title">Восстановление пароля</h1>
                        <div class="form-group">
                            <label for="email">E-mail <i class="requred">*</i></label>

                            <div>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>


                            </div>
                        </div>

                        <div class="form-group text-notification">
                            Введите адрес электронной почты, который вы указали при регистрации.
                        </div>

                        <div class="form-validation-errors"></div>

                        <div class="form-group ">
                            <div class="d-flex justify-content-between form__buttons align-items-center">
                                <button type="submit" class="btn btn-primary">
                                    Восстановить пароль
                                </button>

                                <a class="btn btn-link" href="{{ route('user.registration') }}">
                                    Зарегистрироваться
                                </a>
                            </div>
                        </div>
                    </form>
@endsection
--}}
