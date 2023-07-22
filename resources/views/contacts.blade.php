@extends('layouts.app')

@section('content')
    <div class="page__bread__crumbs">
        <div class="container">

            <a @if(!empty($CityRegion->url)) href="/{{$CityRegion->url}}/" @else href="/" @endif >Главная</a> · <span>{{$dataPageDefault->h1}}</span>
        </div>
    </div>


    <div class="container">

        <div class="page-col-inner">
            <div class="page-col-left s-910">
                <h1 class="page__section_title_two">{{$dataPageDefault->h1}}</h1>
                <div class="contacts-page-info">
                    <p>Служба поддержки работает по будням с 8:00 до 20:00, в выходные с 10:00 до 17:00<br/>
                        по московскому времени</p>
                    <p>Наша электронная почта: <a href="mailto:info@brigada24.ru">info@brigada24.ru</a></p>
                </div>

                <div class="contacts-page-form">
                    <div class="page__user__title">Форма обратной связи</div>
                    <form method="post" action="{{route('contacts.send')}}/" name="contacts-form">
                        @csrf

                        <input type="hidden" class="form-control" name="contacts[adv_id]" @if(!empty($advert_id))value="{{$advert_id}}"@endif/>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label>Ваше имя</label>
                            <input type="text" class="form-control" name="contacts[name]"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label>Ваш e-mail</label>
                            <input type="text" class="form-control" name="contacts[email]"/>
                            <div style="display: none;">
                            <input type="text" class="form-control" name="email"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label>Причина обращения</label>
                            <select class="form-control" name="contacts[theme]">

                                <option value="Платное размещение">Платное размещение</option>
                                <option value="Удаление информации">Удаление информации</option>
                                <option value="Ошибка на сайте">Ошибка на сайте</option>
                                <option value="Технически проблемы">Технически проблемы</option>
                                <option value="Другое">Другое</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-md-12">
                            <label>Ваше сообщение</label>
                            <textarea class="form-control" name="contacts[text]"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12 advert-edit-form-accept">
                            <label for="adv-form-accept">Нажимая кнопку «Отправить», вы соглашаетесь с <a target="_blank" href="{{route('userterms')}}/">правилами пользования сайтом</a> и даёте <a target="_blank" href="{{route('userpolitics')}}/">согласие на обработку персональных данных</a>.</label>
                        </div>
                    </div>


                    <div class="form-validation-errors"></div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-secondary">
                                Отправить
                            </button>
                        </div>
                    </div>
                    </form>
                </div>



            </div>

        </div>


    </div>

@endsection
