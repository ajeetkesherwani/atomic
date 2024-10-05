@extends('Admin.Layout.layout')
@section('content')
@php
$active = 'dashboard';

$total_order = App\Models\Order::count();
$pending_order = App\Models\Order::where('order_status','0')->count();
$confirm_order = App\Models\Order::where('order_status','1')->count();
$cancel_order = App\Models\Order::where('order_status','2')->count();

if(Auth::guard('user')->user()->role == 'warehousemanager'){
$total_wareHou_assign_order = App\Models\Order::where('warehouse_id', '!=' , '')->count();
$total_wareHou_pending_order = App\Models\Order::where(['warehouse_accept' =>'0'])->where('warehouse_id','!=','')->count();
$total_wareHou_accept_order = App\Models\Order::where(['warehouse_accept' =>'1'])->where('warehouse_id','!=','')->count();
$total_wareHou_reject_order = App\Models\Order::where(['warehouse_accept' =>'2'])->where('warehouse_id','!=','')->count();
}

@endphp
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            @if(Auth::guard('user')->user()->role == 'admin')
            <div class="col-6 col-lg-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box text-white" viewBox="0 0 16 16">
                                    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                                </svg>
                            </div>
                        </div>
                        <span class="mb-2 d-block">Todays Payout</span>
                        <h3 class="card-title mb-2">{{$data['product'] ?? '0'}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box text-white" viewBox="0 0 16 16">
                                    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                                </svg>
                            </div>
                        </div>
                        <span class="mb-2 d-block">Todays Comission</span>
                        <h3 class="card-title mb-2">{{$data['product'] ?? '0'}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box text-white" viewBox="0 0 16 16">
                                    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                                </svg>
                            </div>
                        </div>
                        <span class="mb-2 d-block">New Request</span>
                        <h3 class="card-title mb-2">{{$data['product'] ?? '0'}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-suitcase-lg text-white" viewBox="0 0 16 16">
                                    <path d="M5 2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2h3.5A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5H14a.5.5 0 0 1-1 0H3a.5.5 0 0 1-1 0h-.5A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2H5Zm1 0h4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1ZM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5H3V3H1.5ZM15 12.5v-9a.5.5 0 0 0-.5-.5H13v10h1.5a.5.5 0 0 0 .5-.5Zm-3 .5V3H4v10h8Z" />
                                </svg>
                            </div>
                        </div>
                        <span class="mb-2 d-block">Confirm Request</span>
                        <h3 class="card-title mb-2">{{$data['order'] ?? '0'}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-suitcase-lg text-white" viewBox="0 0 16 16">
                                    <path d="M5 2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2h3.5A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5H14a.5.5 0 0 1-1 0H3a.5.5 0 0 1-1 0h-.5A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2H5Zm1 0h4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1ZM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5H3V3H1.5ZM15 12.5v-9a.5.5 0 0 0-.5-.5H13v10h1.5a.5.5 0 0 0 .5-.5Zm-3 .5V3H4v10h8Z" />
                                </svg>
                            </div>
                        </div>
                        <span class="mb-2 d-block">Reject Request</span>
                        <h3 class="card-title mb-2">{{$cancel_order ?? '0'}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-suitcase-lg text-white" viewBox="0 0 16 16">
                                    <path d="M5 2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2h3.5A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5H14a.5.5 0 0 1-1 0H3a.5.5 0 0 1-1 0h-.5A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2H5Zm1 0h4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1ZM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5H3V3H1.5ZM15 12.5v-9a.5.5 0 0 0-.5-.5H13v10h1.5a.5.5 0 0 0 .5-.5Zm-3 .5V3H4v10h8Z" />
                                </svg>
                            </div>
                        </div>
                        <span class="mb-2 d-block">Today Total Transection</span>
                        <h3 class="card-title mb-2">{{$cancel_order ?? '0'}}</h3>
                    </div>
                </div>
            </div>
            @elseif(Auth::guard('user')->user()->role == 'warehousemanager')
            <div class="col-6 col-lg-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box text-white" viewBox="0 0 16 16">
                                    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                                </svg>
                            </div>
                        </div>
                        <span class="mb-2 d-block">New Request</span>
                        <h3 class="card-title mb-2">{{$data['product'] ?? '0'}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-suitcase-lg text-white" viewBox="0 0 16 16">
                                    <path d="M5 2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2h3.5A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5H14a.5.5 0 0 1-1 0H3a.5.5 0 0 1-1 0h-.5A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2H5Zm1 0h4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1ZM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5H3V3H1.5ZM15 12.5v-9a.5.5 0 0 0-.5-.5H13v10h1.5a.5.5 0 0 0 .5-.5Zm-3 .5V3H4v10h8Z" />
                                </svg>
                            </div>
                        </div>
                        <span class="mb-2 d-block">Confirm Request</span>
                        <h3 class="card-title mb-2">{{$data['order'] ?? '0'}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-suitcase-lg text-white" viewBox="0 0 16 16">
                                    <path d="M5 2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2h3.5A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5H14a.5.5 0 0 1-1 0H3a.5.5 0 0 1-1 0h-.5A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2H5Zm1 0h4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1ZM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5H3V3H1.5ZM15 12.5v-9a.5.5 0 0 0-.5-.5H13v10h1.5a.5.5 0 0 0 .5-.5Zm-3 .5V3H4v10h8Z" />
                                </svg>
                            </div>
                        </div>
                        <span class="mb-2 d-block">Reject Request</span>
                        <h3 class="card-title mb-2">{{$cancel_order ?? '0'}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-suitcase-lg text-white" viewBox="0 0 16 16">
                                    <path d="M5 2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2h3.5A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5H14a.5.5 0 0 1-1 0H3a.5.5 0 0 1-1 0h-.5A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2H5Zm1 0h4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1ZM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5H3V3H1.5ZM15 12.5v-9a.5.5 0 0 0-.5-.5H13v10h1.5a.5.5 0 0 0 .5-.5Zm-3 .5V3H4v10h8Z" />
                                </svg>
                            </div>
                        </div>
                        <span class="mb-2 d-block">Today Total Transection</span>
                        <h3 class="card-title mb-2">{{$cancel_order ?? '0'}}</h3>
                    </div>
                </div>
            </div>
            @else
            <div class="col-lg-3 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-suitcase-lg text-white" viewBox="0 0 16 16">
                                    <path d="M5 2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2h3.5A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5H14a.5.5 0 0 1-1 0H3a.5.5 0 0 1-1 0h-.5A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2H5Zm1 0h4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1ZM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5H3V3H1.5ZM15 12.5v-9a.5.5 0 0 0-.5-.5H13v10h1.5a.5.5 0 0 0 .5-.5Zm-3 .5V3H4v10h8Z" />
                                </svg>
                            </div>
                        </div>
                        <span class="mb-2 d-block">Total Assign Order</span>
                        <h3 class="card-title mb-2">{{$total_wareHou_assign_order ?? '0'}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-suitcase-lg text-white" viewBox="0 0 16 16">
                                    <path d="M5 2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2h3.5A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5H14a.5.5 0 0 1-1 0H3a.5.5 0 0 1-1 0h-.5A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2H5Zm1 0h4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1ZM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5H3V3H1.5ZM15 12.5v-9a.5.5 0 0 0-.5-.5H13v10h1.5a.5.5 0 0 0 .5-.5Zm-3 .5V3H4v10h8Z" />
                                </svg>
                            </div>
                        </div>
                        <span class="mb-2 d-block">Pending Order</span>
                        <h3 class="card-title mb-2">{{$total_wareHou_pending_order ?? '0'}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-suitcase-lg text-white" viewBox="0 0 16 16">
                                    <path d="M5 2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2h3.5A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5H14a.5.5 0 0 1-1 0H3a.5.5 0 0 1-1 0h-.5A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2H5Zm1 0h4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1ZM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5H3V3H1.5ZM15 12.5v-9a.5.5 0 0 0-.5-.5H13v10h1.5a.5.5 0 0 0 .5-.5Zm-3 .5V3H4v10h8Z" />
                                </svg>
                            </div>
                        </div>
                        <span class="mb-2 d-block">Accept Order</span>
                        <h3 class="card-title mb-2">{{$total_wareHou_accept_order ?? '0'}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-suitcase-lg text-white" viewBox="0 0 16 16">
                                    <path d="M5 2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2h3.5A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5H14a.5.5 0 0 1-1 0H3a.5.5 0 0 1-1 0h-.5A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2H5Zm1 0h4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1ZM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5H3V3H1.5ZM15 12.5v-9a.5.5 0 0 0-.5-.5H13v10h1.5a.5.5 0 0 0 .5-.5Zm-3 .5V3H4v10h8Z" />
                                </svg>
                            </div>
                        </div>
                        <span class="mb-2 d-block">Reject Order</span>
                        <h3 class="card-title mb-2">{{$total_wareHou_reject_order ?? '0'}}</h3>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@include('Admin.Modal.modal');
@endsection
