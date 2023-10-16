@canany(['members-view', 'members-edit', 'members-delete'])
<div class="d-inline-flex">
    <form action="{{ route('members.destroy',$member->id) }}" method="POST">
        @csrf
        @method('DELETE')
        @can('members-view')
            <a href="{{ route('members.show',$member->id) }}" class="text-teal" data-bs-popup="tooltip" title="Show">
                <i class="ph-eye"></i>
            </a>
        @endcan
        @can('members-edit')
            <a href="{{ route('members.edit',$member->id) }}" class="text-primary" data-bs-popup="tooltip" title="Edit">
                <i class="ph-note-pencil"></i>
            </a>
        @endcan
        @can('members-delete')
            <a href="#" class="text-danger sa-confirm" data-bs-popup="tooltip" title="Delete">
                <i class="ph-trash"></i>
            </a>
        @endcan
    </form>
</div>
@endcanany