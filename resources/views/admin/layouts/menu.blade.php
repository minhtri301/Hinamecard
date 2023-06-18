<li class="nav-header">TRANG QUẢN TRỊ</li>

<li class="nav-item">
    <a href="{{ route('admin.home') }}"
        class="nav-link {{ Request::segment(1) == 'admin' && Request::segment(2) == '' ? 'active' : null }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Trang tổng quan
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('roles.index') }}" style="width: 249px;"
        class="nav-link {{ Request::segment(2) =='roles' ? 'active' : null }}" style="border-radius:0px !important">
        <i class="nav-icon fas fa-user"></i>
        <p>
           Phân quyền quản trị
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('management.index') }}" style="width: 249px;"
        class="nav-link {{ Request::segment(2) == 'management' ? 'active' : null }}" style="border-radius:0px !important">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Quản lý người dùng
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('managementAdmin.index') }}" style="width: 249px;margin-left: 3px; "
        class="nav-link {{ Request::segment(2) == 'managementAdmin' ? 'active' : null }}">
        <i class="nav-icon fas fa-user-shield"></i>
        <p>
            Quản lý quản trị
        </p>
    </a>
</li> 

<li class="nav-item">
    <a href="{{ route('group-management.index') }}" style="width: 249px;"
        class="nav-link {{ Request::segment(2) == 'group-management' ? 'active' : null }}">
        <i class="nav-icon fas fa-layer-group"></i>
        <p>
            Quản lý nhóm người dùng
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('app-store.index') }}" style="width: 249px;"
        class="nav-link {{ Request::segment(2) == 'app-store' ? 'active' : null }}">
        <i class="nav-icon fab fa-adn fa-lg"></i>
        <p>
            Quản lý ứng dụng
        </p>
    </a>
</li>

<li
    class="nav-item {{ Request::segment(2) =='page-sub' ? 'menu-open' : null }}">
    <a href="#" class="nav-link {{ Request::segment(2) =='page-sub' ? 'active' : null }}">
        <i class="nav-icon fas fa-newspaper"></i>
        <p>
            Trang mới
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('page-sub.index') }}"
                class="nav-link {{ Request::segment(2) =='page-sub' && Request::segment(3) =='' ? 'active' : null }} ">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('page-sub.create') }}"
                class="nav-link {{ Request::segment(2) =='page-sub' && Request::segment(3) =='create' ? 'active' : null }}">
                <i class="fas fa-plus-circle nav-icon"></i>
                <p>Thêm trang</p>
            </a>
        </li>
    </ul>
</li>

<!-- SETTING -->
<li class="nav-header">CÀI ĐẶT HỆ THỐNG</li>

<li
    class="nav-item {{ in_array(Request::segment(3), ['general', 'chat-config', 'salary']) || Request::segment(2) =='countries' ? 'menu-open' : null }}">
    <a href="#" class="nav-link {{ in_array(Request::segment(3), ['general', 'chat-config', 'salary']) || Request::segment(2) =='countries' ? 'active' : null }}">
        <i class="nav-icon fas fa-cog"></i>
        <p>
            Cài đặt và cấu hình
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.settings.general') }}"
                class="nav-link {{ Request::segment(3) == 'general' ? 'active' : null }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Cài đặt chung</p>
            </a>
        </li>
    </ul>
</li>