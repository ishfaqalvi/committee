<div class="sidebar-content">
    <div class="sidebar-section">
        <div class="sidebar-section-body d-flex justify-content-center">
            <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>
            <div>
                <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                    <i class="ph-arrows-left-right"></i>
                </button>
                <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                    <i class="ph-x"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="sidebar-section">
        <ul class="nav nav-sidebar" data-nav-type="accordion">
            <li class="nav-item-header pt-0">
                <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
                <i class="ph-dots-three sidebar-resize-show"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link active">
                    <i class="ph-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('roles.index') }}" class="nav-link">
                    <i class="ph-atom"></i>
                    <span>Role</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="ph-users"></i>
                    <span>User</span>
                </a>
            </li>
            <li class="nav-item-header">
                <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Module</div>
                <i class="ph-dots-three sidebar-resize-show"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('managers.index') }}" class="nav-link">
                    <i class="ph-user-list"></i>
                    <span>Manager</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logs') }}" class="nav-link">
                    <i class="ph-headlights"></i>
                    <span>Coommitte</span>
                </a>
            </li>
            <li class="nav-item-header">
                <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Logs</div>
                <i class="ph-dots-three sidebar-resize-show"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('audit.index') }}" class="nav-link">
                    <i class="ph-diamonds-four"></i>
                    <span>Audit</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logs') }}" class="nav-link">
                    <i class="ph-bug"></i>
                    <span>Error</span>
                </a>
            </li>
        </ul>
    </div>
</div>