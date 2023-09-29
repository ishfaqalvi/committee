<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <a href="#" class="dropdown-item">
                <i class="ph-eye me-2"></i>
                View
            </a>
            @if(empty($payment->approval))
            <form action="{{ route('payments.submit',$payment->id) }}" method="POST">
                @csrf
                {{ method_field('PATCH') }}
                <button type="submit" class="dropdown-item sa-submit">
                    <i class="ph-pencil me-2"></i>
                    Submitted
                </button>
            </form>
            @endif
            @if($payment->approval == 'Not Approved')
            <form action="{{ route('payments.approve',$payment->id) }}" method="POST">
                @csrf
                {{ method_field('PATCH') }}
                <button type="submit" class="dropdown-item sa-approve">
                    <i class="ph-check-square me-2"></i>
                    Approved
                </button>
            </form>
            @endif
        </div>
    </div>
</div>