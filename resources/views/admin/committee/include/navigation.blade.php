<div class="d-flex">
    <a 
        href="{{ route('committees.show',$committee->id)}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('committees.show') ? 'active' : ''}}">
        <i class="ph-note-pencil me-1"></i>
        Detail
    </a>
    @can('committeeMembers-list')
    <a 
        href="{{ route('committees.members.index',$committee->id)}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('committees.members.index*') ? 'active' : ''}}">
        <i class="ph-users-three me-1"></i>
        Members
    </a>
    @endcan
    @can('committeeSubmission-list')
    <a 
        href="{{ route('committees.submissions.index',$committee->id)}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('committees.submissions.index*') ? 'active' : ''}}">
        <i class="ph-circle-wavy-check me-1"></i>
        Submissions
    </a>
    @endcan
    @can('committeePayment-list')
    <a 
        href="{{ route('committees.payments.index',$committee->id)}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('committees.payments.index*') ? 'active' : ''}}">
        <i class="ph-money me-1"></i>
        Payments
    </a>
    @endcan
    @can('committeeMembers-list')
    <a 
        href="{{ route('committees.accounts.index',$committee->id)}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('committees.accounts.index*') ? 'active' : ''}}">
        <i class="ph-folder-user me-1"></i>
        Accounts
    </a>
    @endcan
</div>