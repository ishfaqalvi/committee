@canany(['appStrings-view', 'appStrings-edit', 'appStrings-delete'])
    <div class="d-inline-flex">
        <div class="dropdown">
            <a href="#" class="text-body" data-bs-toggle="dropdown">
                <i class="ph-list"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <form action="{{ route('app-strings.destroy',$appString->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @can('appStrings-view')
                        <a href="{{ route('app-strings.show',$appString->id) }}" class="dropdown-item">
                            <i class="ph-eye me-2"></i>{{ __('Show') }}
                        </a>
                    @endcan
                    @can('appStrings-edit')
                        <a href="{{ route('app-strings.edit',$appString->id) }}" class="dropdown-item">
                            <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                        </a>
                    @endcan
                    @can('appStrings-delete')
                        <button type="submit" class="dropdown-item sa-confirm">
                            <i class="ph-trash me-2"></i>{{ __('Delete') }}
                        </button>
                    @endcan
                </form>
            </div>
        </div>
    </div>
@endcanany
