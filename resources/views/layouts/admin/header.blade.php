<div class="page-main-header">
    <div class="main-header-right row m-0">
        <div class="main-header-left">
            <div class="logo-wrapper">
                <a href="/admin"><img class="img-fluid" src="" alt="" /></a>
            </div>
            <div class="dark-logo-wrapper">
                <a href="/admin"><img class="img-fluid" src="" alt="" /></a>
            </div>
            <div class="toggle-sidebar">
                <i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle">
                </i>
            </div>
        </div>
        <div class="left-menu-header col">
            <ul>
                <li>
                    <form class="form-inline search-form">
                        <div class="search-bg">
                            <i class="fa fa-search"></i>
                            <input class="form-control-plaintext" placeholder="@lang('lang.placeholders-search')" />
                        </div>
                    </form>
                    <span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>
                </li>
            </ul>
        </div>
        <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
            
                <li class="onhover-dropdown">
                    <i data-feather="flag"></i>
                    <ul class="chat-dropdown onhover-show-div">
                        <li>
                            <div class="media">
                                <a href="{{ route('changeLanguage') }}?language=vn">
                                    <img class="img-fluid rounded-circle me-3" src="https://w7.pngwing.com/pngs/436/292/png-transparent-flag-of-south-vietnam-flag-of-vietnam-flag-miscellaneous-angle-flag.png" alt="" />
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="media">
                                <a href="{{ route('changeLanguage') }}?language=en">
                                    <img class="img-fluid rounded-circle me-3" src="https://w7.pngwing.com/pngs/434/104/png-transparent-uk-national-flag-illustration-flag-of-great-britain-flag-of-the-united-kingdom-british-flag-miscellaneous-blue-flag.png" alt="" />
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                @if(!Auth::check())
                <li class="onhover-dropdown p-0">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @else
                <li class="onhover-dropdown p-0">
                    <a class="btn btn-primary-light" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();"><i data-feather="log-out"></i>
                        @lang('btn-logout')
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <!-- <a href="{{route('logout')}}" class="btn btn-primary-light" type="button">
                        <i data-feather="log-out"></i>Log out
                    </a> -->
                </li>
                @endif
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto">
            <i data-feather="more-horizontal"></i>
        </div>
    </div>
</div>