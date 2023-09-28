<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                @include('parts.backend.menu_item', [
                    'title' => 'Chuyên mục',
                    'name' => 'categories',
                    'icon' => 'fa fa-cubes',
                ])

                @include('parts.backend.menu_item', [
                    'title' => 'Khóa học',
                    'name' => 'courses',
                    'icon' => 'fa fa-graduation-cap',
                ])

                @include('parts.backend.menu_item', [
                    'title' => 'Giảng viên',
                    'name' => 'teachers',
                    'icon' => 'fa fa-user-circle',
                ])

                @include('parts.backend.menu_item', [
                    'title' => 'Người dùng',
                    'name' => 'users',
                    'icon' => 'fa fa-users',
                ])

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name }}
        </div>
    </nav>
</div>
