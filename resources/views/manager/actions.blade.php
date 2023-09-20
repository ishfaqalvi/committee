<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('managers.destroy',$manager->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="{{ route('managers.show',$manager->id) }}" class="dropdown-item">
                    <i class="ph-eye me-2"></i>{{ __('Show') }}
                </a>
                <a href="{{ route('managers.edit',$manager->id) }}" class="dropdown-item">
                    <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                </a>
                <button type="submit" class="dropdown-item sa-confirm">
                    <i class="ph-trash me-2"></i>{{ __('Delete') }}
                </button>
            </form>
        </div>
    </div>
</div>