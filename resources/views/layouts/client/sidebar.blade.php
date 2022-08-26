@if(Auth::check())
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                <li class="submenu active">
                    <a href="#"><i class="fas fa-user-graduate"></i> <span> My account</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="student-dashboard.html">My profile</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Teachers</span> <span class="menu-arrow"></span></a>
                </li>
                <li>
                    <a href="#"><i class="fas fa-building"></i> <span> Faculties</span> <span class="menu-arrow"></span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-book-reader"></i> <span> Subjects</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="subjects.html">Subject List</a></li>
                        <li><a href="add-subject.html">Register subject</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
@endif