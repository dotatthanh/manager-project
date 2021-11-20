<div class="vertical-menu">

    <div data-simplebar="" class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Quản lý</li>

                {{-- @can('Xem danh sách trung tâm phụ trách') --}}
                <li>
                    <a href="{{ route('centers.index') }}" class=" waves-effect">
                        <i class="bx bx-home-alt"></i>
                        <span>Trung tâm phụ trách</span>
                    </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('Xem danh sách loại dự án') --}}
                <li>
                    <a href="{{ route('types.index') }}" class=" waves-effect">
                        <i class="bx bxs-eraser"></i>
                        <span>Loại dự án</span>
                    </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('Xem danh sách dự án') --}}
                <li>
                    <a href="{{ route('projects.index') }}" class=" waves-effect">
                        <i class="bx bx-briefcase-alt-2"></i>
                        <span>Dự án</span>
                    </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('Xem danh sách công nghệ') --}}
                <li>
                    <a href="{{ route('tech_stacks.index') }}" class=" waves-effect">
                        <i class="bx bx-tone"></i>
                        <span>Công nghệ</span>
                    </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('Xem danh sách khách hàng') --}}
                <li>
                    <a href="{{ route('customers.index') }}" class=" waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span>Khách hàng</span>
                    </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('Xem danh sách nhân sự', 'Xem danh sách vai trò', 'Xem danh sách quyền') --}}
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bx-cog"></i><span class="badge badge-pill badge-info float-right">03</span>
                        <span>Cài đặt</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- @can('Xem danh sách nhân sự') --}}
                        <li><a href="{{ route('users.index') }}">Nhân sự</a></li>
                        {{-- @endcan --}}
                        {{-- @can('Xem danh sách vai trò') --}}
                        <li><a href="{{ route('roles.index') }}">Vai trò</a></li>
                        {{-- @endcan --}}
                        {{-- @can('Xem danh sách quyền') --}}
                        <li><a href="{{ route('permissions.index') }}">Quyền</a></li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                {{-- @endcan --}}

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>