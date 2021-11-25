
    <!-- Sidebar-->
    <div class="iq-sidebar">
        <div class="iq-sidebar-logo d-flex justify-content-between">
            <a href="{{url('/')}}" class="header-logo">
                <img src="{{$system->logo}}" class="img-fluid rounded-normal" alt="">
                <div class="logo-title">
                    <span class="text-primary text-uppercase">{{env('APP_NAME')}}</span>
                </div>
            </a>
            <div class="iq-menu-bt-sidebar">
                <div class="iq-menu-bt align-self-center">
                    <div class="wrapper-menu">
                        <div class="main-circle"><i class="las la-bars"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="sidebar-scrollbar">
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu">
                    <li class="active active-menu"><a href="index.html" class="iq-waves-effect"><i class="las la-home iq-arrow-left"></i><span>Dashboard</span></a></li>

                    <li><a href="rating.html" class="iq-waves-effect"><i class="las la-star-half-alt"></i><span>Favourite </span></a></li>

                    <li><a href="comment.html" class="iq-waves-effect"><i class="las la-comments"></i><span>Watchlist</span></a></li>

                    <li><a href="user.html" class="iq-waves-effect"><i class="las la-user-friends"></i><span>Rate Us</span></a></li>

{{--                    <li>--}}
{{--                        <a href="#category" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="las la-list-ul"></i><span>Category</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>--}}
{{--                        <ul id="category" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">--}}
{{--                            <li><a href="add-category.html"><i class="las la-user-plus"></i>Add Category</a></li>--}}
{{--                            <li><a href="category-list.html"><i class="las la-eye"></i>Category List</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

                </ul>
            </nav>
        </div>
    </div>
