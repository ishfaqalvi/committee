<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="{{ route('users.show',$user->id) }}" class="dropdown-item">
                    <i class="ph-eye me-2"></i>{{ __('Show') }}
                </a>
                <a href="{{ route('users.edit',$user->id) }}" class="dropdown-item">
                    <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                </a>
                <button type="submit" class="dropdown-item sa-confirm">
                    <i class="ph-trash me-2"></i>{{ __('Delete') }}
                </button>
            </form>
        </div>
    </div>
</div>