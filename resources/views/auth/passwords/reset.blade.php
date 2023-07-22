@extends('layouts.app-noheader')

@section('content')

                    <form method="POST" action="{{ route('user.reset.save') }}/" name="form-reset-save">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        {{--<div class="form-group">
                            <label for="email">E-mail адрес <i class="requred">*</i></label>
                            <div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}"  autocomplete="email" autofocus>

                            </div>
                        </div>
--}}
                        <div class="form-group">
                            <label for="password">Пароль <i class="requred">*</i></label>

                            <div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Повторите пароль <i class="requred">*</i></label>

                            <div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-validation-errors"></div>

                        <div class="form-group">
                            <div class="d-flex justify-content-between form__buttons align-items-center">
                                <button type="submit" class="btn btn-primary">
                                    Сбросить пароль
                                </button>
                                <a class="btn btn-link" href="{{ route('user.login') }}">
                                    Вход
                                </a>
                            </div>
                        </div>
                    </form>
@endsection
