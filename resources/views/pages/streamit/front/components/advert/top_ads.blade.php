@foreach($ads as $advert)
    {{--            @if(!empty($advert->position === 'top'))--}}
    {{--                @if(empty($advert->code))--}}
    {{--                    <div class="advert">--}}
    {{--                        <a href="{{$advert->target_url}}">--}}
    {{--                            <img src="{{$advert->banner}}" alt="Helo">--}}
    {{--                        </a>--}}
    {{--                    </div>--}}
    {{--                @else--}}
    <div class="advert">
        <div>
            {{$advert->code}}
        </div>
    </div>
    {{--                @endif--}}
    {{--            @endif--}}
@endforeach

