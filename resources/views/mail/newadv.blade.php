<p>Добавлено новое объявление #{{$mData['id']}}</p>
<p><br/></p>
<p><b>Заголовок:</b> {{$mData['title']}}</p>
<p><b>Описание:</b> {{$mData['description']}}</p>
<p><br/></p>
<p>Перейти к редактированию - <a href="{{route('admin.items.edit',$mData['id'])}}">Перейти</a></p>
