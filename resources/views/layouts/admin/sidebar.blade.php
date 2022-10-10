@if(Auth::check())
<header class="main-nav">
    <div class="sidebar-user text-center">
        <a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="" alt="" />
        <div class="badge-bottom">
            <span class="badge badge-primary">@lang('lang.badge')</span>
        </div>
        <a href="user-profile">
            <img class="img-90 rounded-circle" src="" alt="">
            <h6 class="mt-3 f-14 f-w-600"></h6>
        </a>
        <p class="mb-0 font-roboto">{{Auth::user()->name}}</p>
        <!-- <ul>
            <li>
                <span><span class="counter">19.8</span>k</span>
                <p>Follow</p>
            </li>
            <li>
                <span>2 year</span>
                <p>Experience</p>
            </li>
            <li>
                <span><span class="counter">95.2</span>k</span>
                <p>Follower</p>
            </li>
        </ul> -->
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end">
                            <span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                        </div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>@lang('lang.sidebar.title')</h6>
                        </div>
                    </li>
                    <li>
                        <a class="nav-link menu-title active" href="/"><i data-feather="home"></i><span>@lang('lang.sidebar.homepage')</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="layers"></i><span>@lang('lang.faculties')</span></a>
                        <ul class="nav-submenu menu-content" style="display: none">
                            <li>
                                <a href="{{route('faculties.index')}}" class=""><i class="fa fa-list"></i>@lang('lang.faculties.list')</a>
                            </li>
                            @can('create')
                            <li>
                                <a href="{{route('faculties.create')}}" class=""><i class="fa fa-plus"></i>@lang('lang.faculties.create')</a>
                            </li>
                            @endcan
                        </ul>
                    <li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="book"></i><span>@lang('lang.subjects')</span></a>
                        <ul class="nav-submenu menu-content" style="display: none">
                            <li>
                                <a href="{{route('subjects.index')}}" class=""><i class="fa fa-list"></i>@lang('lang.subjects.list')</a>
                            </li>
                            @can('create')
                            <li>
                                <a href="{{route('subjects.create')}}" class=""><i class="fa fa-plus"></i>@lang('lang.subjects.create')</a>
                            </li>
                            @endcan
                        </ul>
                    <li>
                        @if(Auth::user()->roles[0]['name'] === 'teacher')
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="users"></i><span>@lang('lang.students')</span></a>
                        <ul class="nav-submenu menu-content" style="display: none">
                            <li>
                                <a href="{{route('students.index')}}" class=""><i class="fa fa-list"></i>@lang('lang.students.list')</a>
                            </li>
                            <li>
                                <a href="{{route('students.create')}}" class=""><i class="fa fa-plus"></i>@lang('lang.students.create')</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
@endif