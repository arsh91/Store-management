<!DOCTYPE html>
<html lang="en">

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ url('/dashboard') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                <span class="d-none d-lg-block">Store Management</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        @if(auth()->user()->id == 1)
        <div class="search-bar">
            <form name="storeSelectForm" class="storeSelectForm d-flex align-items-center" method="POST" action="{{ route('stores.selectStore') }}">
                @csrf
            <select class="search_select form-select" style="width: 281.528px;" name="selectStore" id="selectStore">
            <option value="">Select Store</option>
                @foreach($Stores as $store)
                    <option value="{{ $store->storeId }}" {{ ( $store->storeId == session('storeId') ) ? 'selected' : '' }}>
                        {{ $store->name }}
                    </option>
                @endforeach
                </select>
            </form>
        </div>
        @endif
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <!-- <li class="nav-item dropdown"> -->

                <!-- <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span> -->
                <!-- /  </a>End Notification Icon -->

                <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have 4 new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Test</h4>
                                <p>Test here</p>
                                <p>30 min. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Test</h4>
                                <p>Test here</p>
                                <p>1 hr. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Show all notifications</a>
                        </li> -->

                <!-- / </ul>End Notification Dropdown Items -->

                <!-- </li>End Notification Nav -->

                <!-- <li class="nav-item dropdown">-->

                <!-- <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-chat-left-text"></i>
                    <span class="badge bg-success badge-number">3</span>
                </a>End Messages Icon -->

                <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have 3 new messages
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="" alt="" class="rounded-circle">
                                <div>
                                    <h4>Test</h4>
                                    <p>Test here...</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="" alt="" class="rounded-circle">
                                <div>
                                    <h4>Test</h4>
                                    <p>Test here...</p>
                                    <p>6 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Show all messages</a>
                        </li>

                    </ul>End Messages Dropdown Items -->

                <!-- </li>End Messages Nav -->
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <!-- <img src="{{asset('assets/img/').'/'.auth()->user()->profile_picture}}" id="profile_picture"
                        alt="Profile" height="50px" width="50px" class="rounded-circle picture"> -->
                </a>
                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
                        <span
                            class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name ?? " " }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <!-- <img src="{{asset('assets/img/').'/'.auth()->user()->profile_picture}}"
                                        id="profile_picture" alt="Profile" height="50px" width="50px"
                                        class="rounded-circle picture"> -->
                                </div>
                                <div class="col-md-5">
                                    <h6>{{ auth()->user()->first_name ?? " " }}</h6>
                                    <span>{{ auth()->user()->role->name ?? " " }}</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{route('profile')}}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <hr class="dropdown-divider">

                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout')}}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Log Out</span>
                        </a>
                </li>

            </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? '' : 'collapsed' }}" href="{{ url('/dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <!-- @if(auth()->user()->role_id==env('SUPER_ADMIN')) -->
            <!-- <li class="nav-item">
                <a class="nav-link {{ request()->is('departments') ? '' : 'collapsed' }}"
                    href="{{ route('departments.index') }}">
                    <i class="bi bi-buildings"></i>
                    <span>Departments</span>
                </a>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link {{ request()->is('role') ? '' : 'collapsed' }}" href="{{ route('role.index') }}">
                    <i class="bi bi-people"></i>
                    <span>Roles</span>
                </a>
            </li> -->
            <!-- @endif -->
             <li class="nav-item">
                <a class="nav-link {{ request()->is('stores') ? '' : 'collapsed' }}" href="{{ route('stores.index') }}">
                    <i class="bi bi-people"></i>
                    <span>Stores</span>
                </a>
            </li>
            @if(session('storeId'))
            <li class="nav-item">
                <a class="nav-link {{ request()->is('storeinwardvendors') ? '' : 'collapsed' }}" href="{{ route('storeinwardvendors.index') }}">
                    <i class="bi bi-person-square"></i>
                    <span>Store Inward Vendors
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('storeoutwardvendors') ? '' : 'collapsed' }}" href="{{ route('storeoutwardvendors.index') }}">
                    <i class="bi bi-person-square"></i>
                    <span>Store Outward Vendors
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('storeproductcategories') ? '' : 'collapsed' }}" href="{{ route('storeproductcategories.index') }}">
                    <i class="bi bi-person-square"></i>
                    <span>Store Product Category
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('users') ? '' : 'collapsed' }}" href="{{ route('users.index') }}">
                    <i class="bi bi-person-square"></i>
                    <span>Users
                    </span>
                </a>
            </li>
            @endif
            <!-- @if(auth()->user()->role_id==env('SUPER_ADMIN'))
            <li class="nav-item">
                <a class="nav-link {{ request()->is('attendance/teams') ? '' : 'collapsed' }} show"
                    href="{{ route('teams.attendance') }}">
                    <i class="bi bi-person-vcard-fill"></i>
                    <span>Attendance</span>
                </a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link {{ request()->is('attendance') ? '' : 'collapsed' }}"
                    data-bs-target="#attendance-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person-vcard-fill"></i></i><span>Attendance</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="attendance-nav"
                    class="nav-content collapse {{ request()->is('attendance') || request()->is('attendance/teams') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="{{ request()->is('attendance') ? 'active' : 'collapsed' }}"
                            href="{{ route('attendance.index') }}" href="">
                            <i class="bi bi-circle "></i><span>My Attendance</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('attendance/teams') ? 'active' : 'collapsed ' }}"
                            href="{{ route('teams.attendance')}}">
                            <i class="bi bi-circle"></i><span>Team Attendance</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif -->
            <!-- @if(auth()->user()->role_id==env('SUPER_ADMIN'))
            <li class="nav-item">
                <a class="nav-link {{ request()->is('leaves/team') ? '' : 'collapsed' }}"
                    href=" {{ route('team.leaves')}}">
                    <i class="bi bi-menu-button-wide"></i>
                    <span>Leaves</span>
                </a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link {{ request()->is('leaves') ? '' : 'collapsed' }}" data-bs-target="#leaves-nav"
                    data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Leaves</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="leaves-nav"
                    class="nav-content collapse {{ request()->is('leaves') || request()->is('leaves/teams') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a class=" {{ request()->is('leaves') ? 'active' : 'collapsed' }} "
                            href=" {{ route('leaves.index') }}">
                            <i class="bi bi-circle "></i><span>My Leaves</span>
                        </a>
                    </li>
                    <li>
                        <a class=" {{ request()->is('leaves/teams') ? 'active' : 'collapsed' }} "
                            href=" {{ route('team.leaves')}}">
                            <i class="bi bi-circle"></i><span>Team Leaves</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif -->
            <!-- <li class="nav-item">
                <a class="nav-link {{ request()->is('tickets') ? '' : 'collapsed' }}"
                    href="{{ route('tickets.index') }}">
                    <i class="bi bi-journal-code"></i> <span>Tickets</span>
                </a>
            </li> -->    
        </ul>
    </aside><!-- End Sidebar-->
</body>
</html>