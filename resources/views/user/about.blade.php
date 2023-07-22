@if($User->work_experience)
    <div class="text-info-row-fill">Стаж работы {{$User->work_experience}} лет</div>
@else
    <div class="text-info-row-empty">Стаж не указан</div>
@endif

@if($User->about_text)
    <div class="text-info-row-fill">{{$User->about_text}}</div>
@else
    <div class="text-info-row-empty">Ваш опыт не заполнен</div>
@endif
