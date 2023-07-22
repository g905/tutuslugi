@if($User->discount)
    <div class="text-info-row-fill"><b>@if($User->discount!=100){{$User->discount}}% @else Бесплатно @endif</b> {{$User->discount_text}}</div>
@else
    <div class="text-info-row-empty">скидка не указана</div>
@endif


