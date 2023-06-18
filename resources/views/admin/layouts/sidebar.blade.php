<aside class="main-sidebar sidebar-light-lightblue elevation-4">
    <a href="{{ route('admin.home') }}" class="brand-link" target="_blank">
        <img src="{{asset(!empty($site_info->logo) ? $site_info->logo : '/backend/images/logo_admin.png')}}"
             alt="Admin Logo" class="brand-image ">
        <span class="brand-text font-weight-light">{{ !empty($site_info->company) ? $site_info->company : 'Admin' }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('admin.layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
