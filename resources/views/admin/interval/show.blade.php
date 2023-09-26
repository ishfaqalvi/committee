<div class="list-group list-group-borderless py-2">
    <div class="list-group-item fw-semibold">Payments</div>
    @foreach($committee->intervals()->orderBy('order')->get() as $row => $interval)
    @if($interval->status == 'Completed')
        @php($indicator = 'bg-secondary')
    @elseif($interval->status == 'Active')
        @php($indicator = 'bg-success')
    @else
        @php($indicator = 'bg-pink')
    @endif
    <div>
        <a href="#{{ $interval->payments()->count() > 0 ? 'interval'.$row : '' }}" class="list-group-item list-group-item-action hstack gap-3 {{ $interval->status == 'Active' ? '' : 'collapsed'}}" data-bs-toggle="collapse">
            <div class="status-indicator-container">
                <img src="{{ $interval->user->image }}" class="w-40px h-40px rounded-pill" alt="">
                <span class="status-indicator {{ $indicator }}"></span>
            </div>
            <div class="flex-fill">
                <div class="fw-semibold">
                    {{ $interval->user->name }}
                    <span class="badge bg-primary rounded-pill">Date</span>
                </div>
                <span class="text-muted">{{ $interval->user->mobile_number ?? 'Not defined'}}</span>
            </div>
            <div class="align-self-center ms-3">
                <i class="ph-caret-down collapsible-indicator"></i>
            </div>
        </a>
        <div class="collapse {{ $interval->status == 'Active' ? 'show' : ''}}" id="interval{{ $row }}">
            <div class="p-3">
                <ul class="list list-unstyled mb-0">
                    <li><i class="ph-map-pin me-2"></i> Amsterdam</li>
                    <li><i class="ph-briefcase me-2"></i> Senior Designer</li>
                    <li><i class="ph-phone me-2"></i> +1(800)431 8996</li>
                    <li><i class="ph-at me-2"></i> <a href="#">james@alexander.com</a></li>
                </ul>
            </div>
            @include('admin.interval.payment.index')
        </div>
    </div>
    @endforeach
</div>