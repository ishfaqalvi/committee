@canany(['users-view', 'users-edit', 'users-delete'])
<div class="d-inline-flex">
    <form action="{{ route('users.destroy',$user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        @can('users-view')
            <a href="{{ route('users.show',$user->id) }}" class="text-teal" data-bs-popup="tooltip" title="Show">
                <i class="ph-eye"></i>
            </a>
        @endcan
        @can('users-edit')
            <a href="{{ route('users.edit',$user->id) }}" class="text-primary" data-bs-popup="tooltip" title="Edit">
                <i class="ph-note-pencil"></i>
            </a>
        @endcan
        @can('users-delete')
            <a href="#" class="text-danger sa-confirm" data-bs-popup="tooltip" title="Delete">
                <i class="ph-trash"></i>
            </a>
        @endcan
    </form>
</div>
@endcanany