@canany(['roles-view', 'roles-edit', 'roles-delete'])
<div class="d-inline-flex">
    <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
        @csrf
        @method('DELETE')
        @can('roles-view')
            <a href="{{ route('roles.show',$role->id) }}" class="text-teal" data-bs-popup="tooltip" title="Show">
                <i class="ph-eye"></i>
            </a>
        @endcan
        @can('roles-edit')
            <a href="{{ route('roles.edit',$role->id) }}" class="text-primary" data-bs-popup="tooltip" title="Edit">
                <i class="ph-note-pencil"></i>
            </a>
        @endcan
        @can('roles-delete')
            <a href="#" class="text-danger sa-confirm" data-bs-popup="tooltip" title="Delete">
                <i class="ph-trash"></i>
            </a>
        @endcan
    </form>
</div>
@endcanany