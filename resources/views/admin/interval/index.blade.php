@foreach($committee->intervals()->orderBy('order')->get() as $key => $interval)
@if($interval->status == 'Completed')
    @php($bg = 'bg-secondary')
@elseif($interval->status == 'Active')
    @php($bg = 'bg-teal')
@else
    @php($bg = 'bg-pink')
@endif
<div class="col-xl-3 col-sm-6">
    <div class="card {{ $bg }} text-white">
        <div class="card-body text-center">
            <div class="card-img-actions d-inline-block mb-3">
                <img class="img-fluid rounded-circle" src="{{ $interval->user->image }}" width="170" height="170" alt="">
                <div class="card-img-actions-overlay card-img rounded-circle">
                    <a href="#" class="btn btn-outline-white btn-icon rounded-pill" data-bs-toggle="modal" data-bs-target="#editMember{{ $key }}">
                        <i class="ph-note-pencil"></i>
                    </a>
                    @can('intervals-delete')
                    <form action="{{ route('intervals.destroy',$interval->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-white btn-icon rounded-pill ms-2 sa-confirm">
                            <i class="ph-trash"></i>
                        </button>
                    </form>
                    @endcan
                </div>
            </div>
            <h6 class="mb-0">{{ $interval->user->name }}</h6>
            <span class="opacity-75">{{ $interval->user->mobile_number }}</span>
        </div>
    </div>
</div>
@include('admin.interval.edit')
@endforeach