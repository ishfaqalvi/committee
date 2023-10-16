@php($members = $committee->intervals)
<div class="border rounded mb-3">
	<ul class="list-group list-group-borderless media-list-container py-2" id="members-list">
		@foreach($members as $member)
		<li class="list-group-item d-flex align-items-start">
			<a href="#" class="d-inline-flex align-items-center me-3">
				<i class="ph-dots-six dragula-handle me-2"></i>
				<img src="{{ $member->user->image }}" width="40" height="40" class="rounded-circle" alt="">
			</a>
			<div class="flex-fill">
				<div class="fw-semibold">{{ $member->user->name }}</div>
				{{ $member->user->email }}
			</div>
			<div class="ms-3">
				<span class="badge bg-primary">{{ $member->user->mobile_number }}</span>
			</div>
		</li>
		@endforeach
	</ul>
</div>
<a href="#" class="btn btn-info">Save Changes</a>