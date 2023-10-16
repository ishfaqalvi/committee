<div class="d-lg-flex align-items-lg-center mb-4">
    <a href="#" class="d-block me-lg-3 mb-3 mb-lg-0">
        <img src="{{ $committee->user->image }}" class="rounded" width="44" height="44" alt="">
    </a>
    <div class="flex-fill">
        <h5 class="mb-0">{{ $committee->user->name }}</h5>
        <ul class="list-inline list-inline-bullet text-muted mb-0">
            <li class="list-inline-item">{{ $committee->user->mobile_number }}</li>
            <li class="list-inline-item">{{ $committee->user->email }}</li>
        </ul>
    </div>
</div>
<div class="mb-4">
    <h6>{{ $committee->name }}</h6>
    <p>{{ $committee->description }}</p>
    <div class="row px-3">
        <div class="col-lg-6">
            <dl>
                <dt class="fs-sm text-primary text-uppercase mb-2">
                    1. Manager
                </dt>
                <dd class="mb-3">{{ $committee->user->name }}</dd>
                <dt class="fs-sm text-primary text-uppercase mb-2">
                    3. Committee Type</dt>
                <dd class="mb-3">{{ $committee->committeeType->name }}</dd>
                <dt class="fs-sm text-primary text-uppercase mb-2">
                    5. Per Committee Duration</dt>
                <dd class="mb-3">{{ $committee->committeeType->duration_days }} Days</dd>
                <dt class="fs-sm text-primary text-uppercase mb-2">
                    7. Collection Days</dt>
                <dd class="mb-3">{{ $committee->collection_days }} Days</dd>
            </dl>
        </div>
        <div class="col-lg-6">
            <dl>
                <dt class="fs-sm text-primary text-uppercase mb-2">
                    2. Amount
                </dt>
                <dd class="mb-3">{{ number_format($committee->amount) }}</dd>
                <dt class="fs-sm text-primary text-uppercase mb-2">
                    4. Start Date</dt>
                <dd class="mb-3">{{ date('Y-m-d', $committee->start_date) }}</dd>
                <dt class="fs-sm text-primary text-uppercase mb-2">
                    6. End Date</dt>
                <dd class="mb-3">
                    {{ $committee->end_date ?? "Not defined" }}
                <dt class="fs-sm text-primary text-uppercase mb-2">
                    8. Status</dt>
                <dd class="mb-3">{{ $committee->status }}</dd>
            </dl>
        </div>
    </div>
</div>