@canany(['payments-view', 'payments-edit', 'payments-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            @can('payments-view')
            <a href="{{ route('payments.show',$payment->id) }}" class="dropdown-item">
                <i class="ph-eye me-2"></i>{{ __('Show') }}
            </a>
            @endcan
            @if($payment->status == 'Pending' && auth()->user()->can('payments-edit'))
            <a href="{{ route('payments.edit',$payment->id) }}" class="dropdown-item">
                <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
            </a>
            @endif
        </div>
    </div>
</div>
@endcanany
