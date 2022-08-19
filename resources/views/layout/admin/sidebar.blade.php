<header class="main-nav">
    <div class="sidebar-user text-center">
        <a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="" alt="" />
        <div class="badge-bottom">
            <span class="badge badge-primary">New</span>
        </div>
        <a href="user-profile">
            <h6 class="mt-3 f-14 f-w-600"></h6>
        </a>
        <p class="mb-0 font-roboto">Human Resources Department</p>
        <ul>
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
        </ul>
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
                            <h6>General</h6>
                        </div>
                    </li>
                    <li>
                        <a class="nav-link menu-title active" href="/admin"><i data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="layers"></i><span>Faculties</span></a>
                        <ul class="nav-submenu menu-content" style="display: none">
                            <li>
                                <a href="{{route('faculties.index')}}" class=""><i class="fa fa-list"></i>List Faculties</a>
                            </li>
                            <li>
                                <a href="{{route('faculties.create')}}" class=""><i class="fa fa-plus"></i>Create new Faculty</a>
                            </li>
                        </ul>
                    <li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="book"></i><span>Subjects</span></a>
                        <ul class="nav-submenu menu-content" style="display: none">
                            <li>
                                <a href="{{route('subjects.index')}}" class=""><i class="fa fa-list"></i>List Subjects</a>
                            </li>
                            <li>
                                <a href="{{route('subjects.create')}}" class=""><i class="fa fa-plus"></i>Create new subject</a>
                            </li>
                        </ul>
                    <li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="users"></i><span>Subjects</span></a>
                        <ul class="nav-submenu menu-content" style="display: none">
                            <li>
                                <a href="{{route('students.index')}}" class=""><i class="fa fa-list"></i>List Students</a>
                            </li>
                            <li>
                                <a href="{{route('students.create')}}" class=""><i class="fa fa-plus"></i>Create new subject</a>
                            </li>
                        </ul>
                </ul>
            </div>
        </div>
    </nav>
</header>