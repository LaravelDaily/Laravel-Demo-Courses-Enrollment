<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                                    </i>
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon">

                                    </i>
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('discipline_access')
                <li class="nav-item">
                    <a href="{{ route("admin.disciplines.index") }}" class="nav-link {{ request()->is('admin/disciplines') || request()->is('admin/disciplines/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-book-open nav-icon">

                        </i>
                        {{ trans('cruds.discipline.title') }}
                    </a>
                </li>
            @endcan
            @can('institution_access')
                <li class="nav-item">
                    <a href="{{ route("admin.institutions.index") }}" class="nav-link {{ request()->is('admin/institutions') || request()->is('admin/institutions/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-university nav-icon">

                        </i>
                        {{ trans('cruds.institution.title') }}
                    </a>
                </li>
            @endcan
            @can('course_access')
                <li class="nav-item">
                    <a href="{{ route("admin.courses.index") }}" class="nav-link {{ request()->is('admin/courses') || request()->is('admin/courses/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-certificate nav-icon">

                        </i>
                        {{ trans('cruds.course.title') }}
                    </a>
                </li>
            @endcan
            @can('enrollment_access')
                <li class="nav-item">
                    <a href="{{ route("admin.enrollments.index") }}" class="nav-link {{ request()->is('admin/enrollments') || request()->is('admin/enrollments/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-highlighter nav-icon">

                        </i>
                        {{ trans('cruds.enrollment.title') }}
                    </a>
                </li>
            @endcan
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>