@canany(['committees-view', 'committees-edit', 'committees-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            @if($committee->status == 'Pending')
                <form action="{{ route('committees.update',$committee->id) }}" method="POST">
                    @csrf
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="status" value="Active">
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-fast-forward-circle me-2"></i>{{ __('Publish') }}
                    </button>
                </form>
            @endif
            @can('committees-view')
                <a href="{{ route('committees.show',$committee->id) }}" class="dropdown-item">
                    <i class="ph-eye me-2"></i>{{ __('Show') }}
                </a>
            @endcan
            @can('committees-edit')
                <a href="{{ route('committees.edit',$committee->id) }}" class="dropdown-item">
                    <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                </a>
            @endcan
            @can('committees-delete')
                <form action="{{ route('committees.destroy',$committee->id) }}" method="POST">
                @csrf
                @method('DELETE')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                </form>
            @endcan
        </div>
    </div>
</div>
@endcanany