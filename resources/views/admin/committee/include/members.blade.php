@php($members = $committee->intervals->sortBy('order'))

<form action="{{ route('committees.updateInterval') }}" method="post">
    @csrf
    <div class="border rounded mb-3">

        <ul class="list-group list-group-borderless pt-2">
            <li class="list-group-item d-flex align-items-start">
                <input type="hidden" name="ids[]" value="{{ $members[0]->id }}">
                <a href="#" class="d-inline-flex align-items-center me-3">
                    <i class="ph-dots-six me-2"></i>
                    <img src="{{ $members[0]->user->image }}" width="40" height="40" class="rounded-circle"
                        alt="">
                </a>
                <div class="flex-fill">
                    <div class="fw-semibold">{{ $members[0]->user->name }}</div>
                    {{ $members[0]->user->email }}
                </div>
                <div class="ms-3">
                    <span class="badge bg-primary">{{ $members[0]->user->mobile_number }}</span>
                </div>
            </li>
        </ul>
        <ul class="list-group list-group-borderless media-list-container pb-2" id="members-list">
            @foreach ($members as $member)
                @if (!$loop->first)
                    <li class="list-group-item d-flex align-items-start">
                        <input type="hidden" name="ids[]" value="{{ $member->id }}">
                        <a href="#" class="d-inline-flex align-items-center me-3">
                            <i class="ph-dots-six dragula-handle me-2"></i>
                            <img src="{{ $member->user->image }}" width="40" height="40" class="rounded-circle"
                                alt="">
                        </a>
                        <div class="flex-fill">
                            <div class="fw-semibold">{{ $member->user->name }}</div>
                            {{ $member->user->email }}
                        </div>
                        <div class="ms-3">
                            <span class="badge bg-primary">{{ $member->user->mobile_number }}</span>
                        </div>
                        <div class="ms-3">
                            {{-- <form action=""></form> --}}
                            {{-- <form action="{{ route('intervals.destroy', $member->id) }}" method="POST">
                                @csrf
                                @method('DELETE') --}}
                                <a href="#" class=" text-danger sa-confirm delete-member" data-bs-popup="tooltip"
                                    title="Delete" data-id="{{$member->id}}">
                                    <i class="ph-trash"></i>
                                </a>
                            {{-- </form> --}}
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    <button type="submit" class="btn btn-info">Save Changes</button>
</form>
