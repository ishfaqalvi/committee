
<li class="nav-item-header pt-0">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : ''}}" href="{{ route('dashboard') }}">
        <i class="ph-house"></i>
        <span>Dashboard</span>
    </a>
</li>
@canany(['roles-list', 'users-list'])
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Access Management</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
@endcanany
@can('roles-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('roles*') ? 'active' : ''}}" href="{{ route('roles.index') }}">
        <i class="ph-atom"></i>
        <span>Roles</span>
    </a>
</li>
@endcan
@can('users-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('users*') ? 'active' : ''}}" href="{{ route('users.index') }}">
        <i class="ph-users"></i>
        <span>Users</span>
    </a>
</li>
@endcan
@canany(['committees-list','members-list','payments-list'])
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Module</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
@endcanany
@can('members-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('members*') ? 'active' : ''}}" href="{{ route('members.index') }}">
        <i class="ph-folder-user"></i>
        <span>Members</span>
    </a>
</li>
@endcan
@can('committees-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('committees*') ? 'active' : ''}}" href="{{ route('committees.index') }}">
        <i class="ph-bookmarks"></i>
        <span>Committees</span>
    </a>
</li>
@endcan
@can('payments-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('payments*') ? 'active' : ''}}" href="{{ route('payments.index') }}">
        <i class="ph-money"></i>
        <span>Payments</span>
    </a>
</li>
@endcan
@can('appStrings-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('app-strings*') ? 'active' : ''}}" href="{{ route('app-strings.index') }}">
        <i class="ph-star"></i>
        <span>App String</span>
    </a>
</li>
@endcan
@canany(['committeeTypes-list'])
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Catalogs</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
@endcanany
@can('committeeTypes-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('committee-types*') ? 'active' : ''}}" href="{{ route('committee-types.index') }}">
        <i class="ph-list"></i>
        <span>Committee Types</span>
    </a>
</li>
@endcan
@canany(['notifications-list','audits-list', 'logs-list'])
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Configuration</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
@endcanany
@can('audits-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('notifications*') ? 'active' : ''}}" href="{{ route('notifications.index') }}">
        <i class="ph-bell"></i>
        <span>Notifications</span>
    </a>
</li>
@endcan
@can('audits-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('audits*') ? 'active' : ''}}" href="{{ route('audits.index') }}">
        <i class="ph-diamonds-four"></i>
        <span>Audit</span>
    </a>
</li>
@endcan
@can('logs-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('logs*') ? 'active' : ''}}" href="{{ route('logs') }}" target="_blank">
        <i class="ph-bug"></i>
        <span>Errors</span>
    </a>
</li>
@endcan
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('settings') ? 'active' : ''}}" href="{{ route('logs') }}" target="_blank">
        <i class="ph-gear"></i>
        <span>Settings</span>
    </a>
</li>
