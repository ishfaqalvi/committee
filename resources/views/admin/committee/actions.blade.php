@canany(['committees-view', 'committees-edit', 'committees-delete'])
<div class="d-inline-flex">
    @can('committees-view')
        <a href="{{ route('committees.show',$committee->id) }}" class="text-teal" data-bs-popup="tooltip" title="Show">
            <i class="ph-eye"></i>
        </a>
    @endcan
    @if($committee->status == 'Pending')
        <form action="{{ route('committees.update',$committee->id) }}" method="POST">
            @csrf
            {{ method_field('PATCH') }}
            <input type="hidden" name="status" value="Active">
            <a href="#" class="text-primary sa-publish" data-bs-popup="tooltip" title="Publish">
                <i class="ph-fast-forward-circle"></i>
            </button>
        </form>
    @endif
    @if($committee->status == 'Pending' && auth()->user()->can('committees-edit'))
        <a href="{{ route('committees.edit',$committee->id) }}" class="text-primary" data-bs-popup="tooltip" title="Edit">
            <i class="ph-note-pencil"></i>
        </a>
    @endif
    @if($committee->status == 'Pending' && auth()->user()->can('committees-delete'))
        <form action="{{ route('committees.destroy',$committee->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <a href="#" class="text-danger sa-confirm" data-bs-popup="tooltip" title="Delete">
                <i class="ph-trash"></i>
            </a>
        </form>
    @endif
</div>
@endcanany