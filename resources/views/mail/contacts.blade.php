<p>Имя: {{$mData['inputs']['name']}}</p>
<p>E-mail: {{$mData['inputs']['email']}}</p>
<p>Тема: {{$mData['inputs']['theme']}}</p>
<p>Сообщение: {{$mData['inputs']['text']}}</p>
@if($mData['inputs']['adv_id'])
<p>ID объявления: {{$mData['inputs']['adv_id']}}</p>
@endif
