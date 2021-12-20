
<footer class="mb-0">
    <div class="container-fluid">
        <div class="block-space">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <ul class="f-link list-unstyled mb-0">
                        @foreach($pages as $page)
                                @if($page->position === 1)
                                    <li><a href="{{route($page->url)}}">{{$page->title}}</a></li>
                                @endif

                                @if($page->position === 2)
                                    <li><a href="{{route($page->url)}}">{{$page->title}}</a></li>
                                @endif

                                @if($page->position === 3)
                                    <li><a href="{{route($page->url)}}">{{$page->title}}</a></li>
                                @endif

                                @if($page->position === 4)
                                    <li><a href="{{route($page->url)}}">{{$page->title}}</a></li>
                                @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <ul class="f-link list-unstyled mb-0">
                        @foreach($pages as $page)
                            @if($page->position === 5)
                                <li><a href="{{route($page->url)}}">{{$page->title}}</a></li>
                            @endif

                            @if($page->position === 6)
                                <li><a href="{{route($page->url)}}">{{$page->title}}</a></li>
                            @endif

                            @if($page->position === 7)
                                <li><a href="{{route($page->url)}}">{{$page->title}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <ul class="f-link list-unstyled mb-0">
                        @foreach($pages as $page)
                            @if($page->position === 8)
                                <li><a href="{{route($page->url)}}">{{$page->title}}</a></li>
                            @endif
                            @if($page->position === 9)
                                <li><a href="{{route($page->url)}}">{{$page->title}}</a></li>
                            @endif

                            @if($page->position === 10)
                                <li><a href="{{route($page->url)}}">{{$page->title}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-3 col-md-12 r-mt-15">
                    <div class="d-flex">
                        <a href="#" class="s-icon">
                            <i class="ri-facebook-fill"></i>
                        </a>
                        <a href="#" class="s-icon">
                            <i class="ri-skype-fill"></i>
                        </a>
                        <a href="#" class="s-icon">
                            <i class="ri-linkedin-fill"></i>
                        </a>
                        <a href="#" class="s-icon">
                            <i class="ri-whatsapp-fill"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright py-2">
        <div class="container-fluid">
            <p class="mb-0 text-center font-size-14 text-body">{{env('APP_NAME')}} - 2020 All Rights Reserved</p>
        </div>
    </div>
</footer>
