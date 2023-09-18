<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('audit.destroy',$audit->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="{{ route('audit.show',$audit->id) }}" class="dropdown-item">
                    <i class="ph-eye me-2"></i>{{ __('Show') }}
                </a>
                <button type="submit" class="dropdown-item sa-confirm">
                    <i class="ph-trash me-2"></i>{{ __('Delete') }}
                </button>
            </form>
        </div>
    </div>
</div>