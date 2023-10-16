@canany(['notifications-view', 'notifications-delete'])
<div class="d-inline-flex">
    <form action="{{ route('notifications.destroy',$notification->id) }}" method="POST">
        @csrf
        @method('DELETE')
        @can('notifications-view')
            @if(!$notification->read_at)
                <a href="{{ route('notifications.show',$notification->id) }}" class="text-teal" data-bs-popup="tooltip" title="Mark as Read">
                    <i class="ph-eye"></i>
                </a>
            @endif
        @endcan
        @can('notifications-delete')
            <a href="#" class="text-danger sa-confirm" data-bs-popup="tooltip" title="Delete">
                <i class="ph-trash"></i>
            </a>
        @endcan
    </form>
</div>
@endcanany