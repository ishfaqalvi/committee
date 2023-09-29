@if($interval->payments()->count() > 0)
<div class="row ps-3 pe-2 mt-2">
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-primary text-white">
            <div class="d-flex align-items-center">
                <div class="flex-fill">
                    <h4 class="mb-0">
                        {{ number_format(count($interval->committee->intervals) * $interval->committee->amount) }}
                    </h4>
                    Total Amount
                </div>
                <i class="ph-money ph-2x opacity-75"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-danger text-white">
            <div class="d-flex align-items-center">
                <div class="flex-fill">
                    <h4 class="mb-0">{{ number_format($interval->payable) }}</h4>
                    Total Pay
                </div>
                <i class="ph-money ph-2x opacity-75"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-success text-white">
            <div class="d-flex align-items-center">
                <i class="ph-money ph-2x opacity-75"></i>
                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ number_format($interval->receivable) }}</h4>
                    Total Receive
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-indigo text-white">
            <div class="d-flex align-items-center">
                <i class="ph-users-three ph-2x opacity-75"></i>
                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ number_format(count($interval->payments)) }}</h4>
                    Total Member
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row ps-3 pe-2">
    <table class="table media-library">
    <thead>
        <tr>
            <th>Preview</th>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>Date</th>
            <th>Approval</th>
            <th>Status</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($interval->payments as $payment)
        <tr>
            <td><img src="{{ $payment->user->image }}" alt="" class="w-40px h-40px rounded-pill"></td>
            <td>{{ $payment->user->name }}</td>
            <td>{{ $payment->user->mobile_number ?? 'Not Defined' }}</td>
            <td>@if(!empty($payment->date)){{ date('Y-m-d', $payment->date) }}@endif</td>
            <td>{{ $payment->approval }}</td>
            <td>
                {{ $payment->status }}
                @php($tag = $payment->tags)
                @if(!empty($tag) && $tag == 'Late')
                    <span class="badge bg-warning rounded-pill">{{ $tag }}</span>
                @endif 
                @if(!empty($tag) && $tag == 'On Time')
                    <span class="badge bg-success rounded-pill">{{ $tag }}</span>
                @endif 
            </td>
            <td class="text-center">@include('admin.interval.payment.actions')</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endif