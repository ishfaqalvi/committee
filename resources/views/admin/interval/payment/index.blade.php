<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-primary text-white">
            <div class="d-flex align-items-center">
                <div class="flex-fill">
                    <h4 class="mb-0">
                        {{ number_format(count($interval->committee->intervals) * $interval->committee->amount) }}
                    </h4>
                    Total Amount
                </div>
                <i class="ph-chats ph-2x opacity-75 ms-3"></i>
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
                <i class="ph-package ph-2x opacity-75 ms-3"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-success text-white">
            <div class="d-flex align-items-center">
                <i class="ph-hand-pointing ph-2x opacity-75 me-3"></i>
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
            <th>File info</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($interval->payments as $payment)
        <tr>
            <td>
                <a href="../../../assets/images/demo/flat/1.png" data-bs-popup="lightbox">
                    <img src="{{ $payment->user->image }}" alt="" class="img-preview rounded">
                </a>
            </td>
            <td><a href="#">{{ $payment->user->name }}</a></td>
            <td><a href="#">{{ $payment->user->mobile_number ?? 'Not Defined' }}</a></td>
            <td>{{ $payment->date }}</td>
            <td>{{ $payment->status }}</td>
            <td>
                <ul class="list-unstyled mb-0">                                                 
                    <li><span class="fw-semibold">Size:</span> 215 Kb</li>
                    <li><span class="fw-semibold">Format:</span> .jpg</li>
                </ul>
            </td>
            <td class="text-center">
                <div class="d-inline-flex">
                    <div class="dropdown">
                        <a href="#" class="text-body" data-bs-toggle="dropdown">
                            <i class="ph-list"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="#" class="dropdown-item">
                                <i class="ph-pencil me-2"></i>
                                Edit file
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="ph-copy me-2"></i>
                                Copy file
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="ph-eye-slash me-2"></i>
                                Unpublish
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="ph-trash me-2"></i>
                                Move to trash
                            </a>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>