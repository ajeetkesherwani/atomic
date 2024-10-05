@extends('Admin.Layout.layout')
@section('content')
@php
$active = 'bank';
@endphp
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-6">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / </span>Bank List</h4>
            </div>
            <div class="col-6 text-end">
                <a href="{{route('bank_create')}}"><button type="button" class="btn btn-primary">Add</button></a>
            </div>

        </div>

        <!-- Borderless Table -->
        <!-------------- Session message ---------------->
        @if (Session::has('success'))
        <div class="alert alert-success">
            <p>{{Session::get('success')}}</p>
        </div>
        @endif
        <!-------------- Session message ---------------->
        <div class="card p-2">
            <div class="table-responsive text-nowrap">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            @if(Auth::guard('user')->user()->role == 'admin')
                            <th>Company Name</th>
                            @endif
                            <th>Name</th>
                            <th>Type</th>
                            <th>Account No</th>
                            <th>IFSC Code</th>
                            <th>Account Limit</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['bank_details'] as $item)
                        <tr>
                            @if(Auth::guard('user')->user()->role == 'admin')
                            <th>{{$item->companyData->name}}</th>
                            @endif
                            <td class="d-flex">
                                <strong>{{$item->bank_name}}</strong>
                            </td>
                            <td>
                                @if($item->payment_type == '1')
                                UPI
                                @elseif($item->payment_type == '2')
                                RTGS
                                @elseif($item->payment_type == '3')
                                NEFT
                                @else
                                IMPS
                                @endif
                            </td>
                            <td>{{$item->account_no}}</td>
                            <td>{{$item->ifsc_code}}</td>
                            <td>{{$item->account_limit}}</td>
                            <td>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{$item->status == '1' ? 'checked' : ''}}>
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-success" class="edit_category" href="{{route('bank_edit',['id'=>$item->id])}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                    Edit
                                </a>
                                <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" href="{{route('global_delete',['type'=>'bank_details','id'=>$item->id])}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                    </svg>Delete</a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            <style>
                .inline-flex {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .flex {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .d-flex nav {
                    display: block !important;
                }

                .w-5 {
                    width: 23px;
                    height: 23px;
                }

                div nav .justify-between {
                    display: none;
                }

                .sm:justify-between div p {
                    display: none;
                }

            </style>
            <div class="d-flex justify-content-center">
                {!! $data['bank_details']->links() !!}
            </div>
        </div>
    </div>
</div>

@endsection
