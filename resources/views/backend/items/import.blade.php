@extends('layouts.admin')

@section('content')
    <main class="main-page-inner">
        <h3 class="title-3 m-b-30">Импорт объявлений CSV</h3>

        <form id="items-price-import" enctype="multipart/form-data" class="form-header m-b-15" action="{{route('admin.items.import')}}/"
              method="post">
            @csrf
            <input class="au-input au-input--xl" accept=".csv" type="file" name="csv" id="csv" value="{{request()->get('csv')}}">
            <button class="btn btn-secondary" type="submit">
                Загрузить файл
            </button>
        </form>

        <div class="progress mb-3" id="import-progress-bar" style="display: none;">
            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>

        <div class="table-responsive">
            @if(!empty($LogImport))
                @foreach($LogImport as $Import)
                    @foreach($Import[0] as $ImportSuccess)
                        <div class="text-success">{{$ImportSuccess}}</div>
                    @endforeach
                    @foreach($Import[1] as $ImportSuccess)
                        <div class="text-danger">{{$ImportSuccess}}</div>
                    @endforeach
                @endforeach
            @endif

        </div>
    </main>
@endsection
