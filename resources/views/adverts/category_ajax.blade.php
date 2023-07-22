@if(!empty($Adverts))

    @foreach($Adverts as $advert)
        @include('adverts.listitem')
    @endforeach
    @endif
