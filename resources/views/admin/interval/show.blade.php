<div class="list-group list-group-borderless py-2">
    <div class="list-group-item fw-semibold">Payments</div>
    @foreach($committee->intervals()->orderBy('order')->get() as $row => $interval)
    @if($interval->status == 'Closed')
        @php($indicator = 'bg-secondary')
    @elseif($interval->status == 'Active')
        @php($indicator = 'bg-success')
    @else
        @php($indicator = 'bg-pink')
    @endif
    <div>
        <a href="#{{ $interval->payments()->count() > 0 ? 'interval'.$row : '' }}" class="list-group-item list-group-item-action hstack gap-3 {{ $interval->status == 'Active' ? '' : 'collapsed'}}" data-bs-toggle="collapse">
            <div class="status-indicator-container">
                <img src="{{ $interval->user->image }}" class="img-preview rounded" alt="">
                <span class="status-indicator {{ $indicator }}"></span>
            </div>
            <div class="flex-fill">
                <div class="fw-semibold">
                    {{ $interval->user->name }}
                </div>
                <span class="text-muted">{{ $interval->user->mobile_number ?? 'Not defined'}}</span>
            </div>
            @if($interval->start_date)
            <span class="badge bg-primary rounded-pill">
                {{ date('Y-m-d', $interval->start_date).' / '.date('Y-m-d', $interval->close_date) }}
            </span>
            @endif
            <div class="align-self-center ms-3">
                <i class="ph-caret-down collapsible-indicator"></i>
            </div>
        </a>
        <div class="collapse {{ $interval->status == 'Active' ? 'show' : ''}}" id="interval{{ $row }}">
            @include('admin.interval.payment.index')
        </div>
    </div>
    @endforeach
</div>