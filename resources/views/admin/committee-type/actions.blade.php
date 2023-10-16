@canany(['committeeTypes-edit', 'committeeTypes-delete'])
<div class="d-inline-flex">
    <form action="{{ route('committee-types.destroy',$committeeType->id) }}" method="POST">
        @csrf
        @method('DELETE')
        @can('committeeTypes-edit')
            <a href="{{ route('committee-types.edit',$committeeType->id) }}" class="text-primary" data-bs-popup="tooltip" title="Edit">
                <i class="ph-note-pencil"></i>
            </a>
        @endcan
        @can('committeeTypes-delete')
            <a href="#" class="text-danger sa-confirm" data-bs-popup="tooltip" title="Delete">
                <i class="ph-trash"></i>
            </a>
        @endcan
    </form>
</div>
@endcanany