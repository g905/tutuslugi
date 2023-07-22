@extends('layouts.app')

@section('content')
    <div class="container">
        @include("user.menu")
        <div class="page-col-inner">


            <div class="page-col-left s-895">


                <div class="user-cabinet-section">
                    <div class="user-cabinet-title">
                        <a href="{{route('user.profile')}}"><i>
                                <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M8.54689 0.227009C8.61882 0.298889 8.67588 0.384239 8.71482 0.478182C8.75375 0.572125 8.77379 0.672818 8.77379 0.774509C8.77379 0.8762 8.75375 0.976893 8.71482 1.07084C8.67588 1.16478 8.61882 1.25013 8.54689 1.32201L2.64289 7.22601H15.2259C15.4312 7.22601 15.628 7.30756 15.7732 7.45271C15.9183 7.59786 15.9999 7.79473 15.9999 8.00001C15.9999 8.20529 15.9183 8.40216 15.7732 8.54731C15.628 8.69246 15.4312 8.77401 15.2259 8.77401H2.64289L8.54689 14.678C8.6204 14.7495 8.67897 14.8348 8.71922 14.9291C8.75946 15.0234 8.78057 15.1248 8.78131 15.2273C8.78205 15.3299 8.76242 15.4315 8.72355 15.5264C8.68468 15.6213 8.62735 15.7075 8.55488 15.78C8.48242 15.8525 8.39626 15.9099 8.30142 15.9489C8.20658 15.9879 8.10495 16.0076 8.00242 16.0069C7.8999 16.0063 7.79852 15.9853 7.70418 15.9451C7.60985 15.905 7.52443 15.8465 7.45289 15.773L0.226887 8.54701C0.0819179 8.40188 0.000488281 8.20514 0.000488281 8.00001C0.000488281 7.79488 0.0819179 7.59814 0.226887 7.45301L7.45289 0.227009C7.59802 0.08204 7.79476 0.000610352 7.99989 0.000610352C8.20502 0.000610352 8.40176 0.08204 8.54689 0.227009Z"
                                          fill="black"/>
                                </svg>
                            </i></a> Настройки
                    </div>


                    <section class="user-text-default">
                        <div class="settings-form-title">Личные данные</div>

                        <form method="POST" action="{{ route('user.settings') }}/" name="form-user-settings">
                            @csrf
                            <div class="form-ui-style-default">
                                <div class="form-group">
                                    <label for="name">ФИО <i class="requred">*</i></label>

                                    <div>
                                        <input maxlength="60" id="name" type="text" class="form-control " name="name"
                                               value="{{Auth::user()->name}}" autocomplete="name" >
                                    </div>
                                </div>

                                <div class="form-group d-none">
                                    <label for="password">E-mail </label>

                                    <div>
                                        <input id="email" value="{{Auth::user()->email}}" type="email" class="form-control" name="email"
                                               autocomplete="email">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <label for="email">Номер телефона <i class="requred">*</i></label>

                                    @if(!empty(old('phone')))
                                        <div>
                                            <input id="phone" type="text" class="form-control " name="phone"
                                                   value="{{old('phone')}}" autocomplete="phone">
                                        </div>
                                        @else
                                    <div>
                                        <input id="phone" type="text" class="form-control " name="phone"
                                               value="+{{Auth::user()->phone}}" autocomplete="phone">
                                    </div>
                                        @endif
                                </div>

                                @if((!empty($ShowCodeForm) && $ShowCodeForm==1))

                                    <div class="form-group form-text-info">
                                        Для подтверждения смены телефона, на указанный Вами номер был отправлен звонок.<br/>
                                        Кодом подтверждения являются последние 4 цифры позвонившего Вам номера.
                                    </div>

                                    <div class="form-group">
                                        <label>Код подтверждения <i class="requred">*</i></label>

                                        <div>
                                            <input id="code" type="text" class="form-control " name="code" value="{{ old('code') }}"  autocomplete="code" placeholder="Последние 4 цифры позвонившего Вам номера">
                                        </div>
                                    </div>
                                @endif



                                @if ($errors->any() && !empty(session('UserSettings')))
                                <div class="form-validation-errors  alert alert-danger  ">
                                    @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                            <div class="">
                                                {{ $error }}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                @endif
                                <div class="form-group">
                                    <div class="d-flex justify-content-between form__buttons align-items-center">
                                        <button type="submit" class="btn btn-primary">
                                            Сохранить
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>

                    <section class="user-text-default">
                        <div class="settings-form-title">Сменить пароль</div>

                        <form method="POST" action="{{ route('user.password') }}/"  name="form-user-password">
                            @csrf
                            <div class="form-ui-style-default">
                                <div class="form-group">
                                    <label for="name">Старый пароль <i class="requred">*</i></label>

                                    <div>
                                        <input id="password" required type="password" class="form-control" name="password-old"  autocomplete="new-password" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password">Новый пароль <i class="requred">*</i></label>

                                    <div>
                                        <input id="password" required type="password" class="form-control" name="password"  autocomplete="new-password">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Повторите новый пароль <i class="requred">*</i></label>

                                    <div>
                                        <input id="password-confirm" required type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                    </div>
                                </div>



                                @if ($errors->any() && !empty(session('UserPassword')))
                                <div class="form-validation-errors   alert alert-danger ">
                                    @if ($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div class="">
                                                    {{ $error }}
                                                </div>
                                        @endforeach
                                    @endif</div>
                                @endif
                                <div class="form-group">
                                    <div class="d-flex justify-content-between form__buttons align-items-center">
                                        <button type="submit" class="btn btn-primary">
                                            Изменить пароль
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
