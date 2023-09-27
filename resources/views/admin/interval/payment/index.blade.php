<div class="row mt-2">
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-primary text-white">
            <div class="d-flex align-items-center">
                <div class="flex-fill">
                    <h4 class="mb-0">
                        {{ number_format(count($interval->committee->intervals) * $interval->committee->amount) }}
                    </h4>
                    Total Amount
                </div>
                <i class="ph-money ph-2x opacity-75 ms-3"></i>
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
                <i class="ph-money ph-2x opacity-75 ms-3"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-success text-white">
            <div class="d-flex align-items-center">
                <i class="ph-money ph-2x opacity-75 me-3"></i>
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
                <i class="ph-users-three ph-2x opacity-75 me-3"></i>
                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ number_format(count($interval->payments)) }}</h4>
                    Total Member
                </div>
            </div>
        </div>
    </div>
</div>
<table class="table media-library">
    <thead>
        <tr>
            <th>Preview</th>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>Date</th>
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
            <td>{{ $payment->date }}</td>
            <td>{{ $payment->status }}</td>
            <td class="text-center">
                @if($payment->status == 'Submitted')
                    <button type="button" class="btn btn-flat-success btn-labeled btn-sm">
                        View
                    </button>
                @else
                <form method="POST" action="{{ route('payments.update', $payment->id) }}">
                    @csrf
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="status" value="Submitted">
                    <button type="submit" class="sa-submit btn btn-flat-success btn-labeled btn-sm">
                        Submitt
                    </button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>