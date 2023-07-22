@extends('layouts.admin')

@section('content')  <main class="main-page-inner">
    <h3 class="title-3 m-b-30">Сообщения</h3>



    <div class="table-responsive">
        <table class="table table-top-campaign">
            <thead>
            <tr>
                <th>Контакты</th>
                <th style="width: 400px">Сообщение</th>
                <th>ID объявления</th>
                <th style="width: 150px">Дата обращения</th>
            </tr>
            </thead>
            <tbody>
            @foreach($listItems as $Item)
                <tr>
                    <td>{{$Item->email}}</td>
                    <td>{{$Item->text}}</td>
                    <td>@if($Item->adv_id)<a target="_blank" href="{{route('admin.items.edit',$Item->adv_id)}}">{{$Item->adv_id}}</a>  @endif</td>
                    <td>{{$Item->date_add}}</td>


                </tr>

            @endforeach

            </tbody>
        </table>

        {{ $listItems->links('vendor.pagination.bootstrap-4') }}
    </div>
</main>
@endsection
