@canany(['audits-view', 'audits-delete'])
<div class="d-inline-flex">
    <form action="{{ route('audits.destroy',$audit->id) }}" method="POST">
        @csrf
        @method('DELETE')
        @can('audits-view')
            <a href="{{ route('audits.show',$audit->id) }}" class="text-teal" data-bs-popup="tooltip" title="Show">
                <i class="ph-eye"></i>
            </a>
        @endcan
        @can('audits-delete')
            <a href="#" class="text-danger sa-confirm" data-bs-popup="tooltip" title="Delete">
                <i class="ph-trash"></i>
            </a>
        @endcan
    </form>
</div>
@endcanany