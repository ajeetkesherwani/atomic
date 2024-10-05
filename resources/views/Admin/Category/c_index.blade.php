@extends('Admin.Layout.layout')
@section('content')
@php
if($data['type'] == 'new'){
$active = 'new_request';
}
elseif($data['type'] == 'approved'){
$active = 'approved_request';
}
elseif($data['type'] == 'reject'){
$active = 'reject_request';
}

switch($data['type']){
case 'new':
$type = 'New';
$cat_placeholder = 'Select New';
break;
case 'approved':
$type = 'Approved';
$cat_placeholder = 'Select Approved';
break;
case 'reject':
$type = 'Reject';
$cat_placeholder = 'Select Reject';
break;
}


@endphp

<style>
    .cus_btn_padding {
        padding: 0.4345rem 0.5rem;
    }

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
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-6">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span>
                    @if(!empty($data['type']))
                    {{$type}}
                    @endif
                    Request</h4>
            </div>
        </div>
        <!-- Borderless Table -->

        <div class="card col-12 col-md-1 col-lg-12 mb-2">
            <section>
                <div class="container mt-4 mb-4">
                    <div class="row">
                        {{-- <h5 class="fw-bold">Add
                            @if(!empty($data['type']))
                            {{$data['type']}}
                        @endif
                        Category</h5> --}}
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="bg-white">
                                <form class="row g-3" method="post" action="{{ route('add-category',['type'=>$type]) }}" enctype="multipart/form-data">
                                    @csrf

                                    {{-- <div class="col-md-6 col-lg-4 col-sm-12 mt-3">
                                        <select class="form-select" id="cat_id" name="cat_id" aria-label="Default select example" required>
                                            <option disabled selected value="">{{$cat_placeholder}}</option>
                                    @foreach ($data['category'] as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                    </select>
                            </div> --}}
                            <div class="col-md-6 col-lg-4 col-sm-12">
                                <label>Start Time</label>
                                <input type="date" class="form-control" name="name" id="name" placeholder="Enter Name" aria-label="Enter Name" value="{{old('name')}}" required>
                            </div>
                            <div class="col-md-6 col-lg-3 col-sm-12 mt-3">
                                <label>End Time</label>
                                <input type="date" name="image" class="form-control" id="image" placeholder="Choose Image">
                            </div>
                            <div class="col-md-2 col-lg-1 col-sm-12 text-end">
                                <label></label>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
        </section>
    </div>

    <div class="card col-12 col-md-1 col-lg-12 mb-2">
        <section>
            <div class="container mt-4 mb-4">
                <div class="row">
                    <h5 class="fw-bold">Search
                        @if(!empty($data['type']))
                        {{$type}}
                        @endif
                        Request</h5>
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="bg-white">
                            <form class="row g-3" method="post" action="{{ route('categoryList',['type'=>$type]) }}" enctype="multipart/form-data">
                                @csrf

                                <div class="col-md-6 col-lg-4 col-sm-12">
                                    <input type="text" class="form-control" name="search" placeholder="Search {{$type}} request By transection id" aria-label="Enter Name" required>
                                </div>

                                <div class="col-md-2 col-lg-1 col-sm-12 text-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!--- Session flash message -------->
    @if(Session::has('success'))
    <div class="flash-message">
        <p class="alert alert-success">{{ Session::get('success') }}</p>
    </div>
    @endif
    <!--- Session flash message -------->

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card p-2">
        <div class="table-responsive text-nowrap">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>SR no</th>
                        <th>Order Id</th>
                        <th>Transection No</th>
                        <th>Transection Date</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data['category_data'] as $key=>$item)
                    <tr>
                        <td>
                            <strong>{{$key+1}}</strong>
                        </td>
                        <td>
                            <strong>{{$item->name}}</strong>
                        </td>
                        <td>
                            <strong>{{$item->name}}</strong>
                        </td>
                        <td>
                            <strong>{{$item->name}}</strong>
                        </td>
                        <td>
                            <strong>{{$item->name}}</strong>
                        </td>
                        <td class="d-flex">
                            <div class="">
                                <a class="btn btn-sm btn-success" id="" data-id="{{$item->id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                    Approved
                                </a>
                            </div>
                            <div class="mx-1">
                                <a href="{{route('deleteCtypcat',['type'=>'all','id'=>$item->id])}}" class="btn btn-sm btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                    </svg>Delete</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <h5 class="text-center">There is no any category are available!</h5>
                        </td>
                    </tr>
                    @endforelse
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
    </div>
    <!--/ Borderless Table -->
</div>
</div>
<script>
    setTimeout(function() {
        $('.flash-message').fadeOut('fast');
    }, 2000)

    $('.editCatrgory').on("click", function() {
        var cat_id = $(this).data("id");
        console.log(cat_id);
        axios.post("{{route('edit-category',['type'=>'all','id'=>'0'])}}", {
            'id': cat_id
        , }).then(res => {
            console.log(res);
            console.log(res.data.data.name);
            $('#cat_id').val(res.data.data.id);
            $('#edit_cat_name').val(res.data.data.name);
            $('#edit_cat_description').val(res.data.data.description);
        }).catch(error => {
            console.error(error);
        });
    });

    $('.delete_cat_btn').on("click", function() {
        var cat_id = $(this).data("id");
        console.log(cat_id);
        $('#delete_id').val(cat_id);
    });

    $('#delete_category_btn').on("click", function() {
        var delete_id = $('#delete_id').val();
        axios.post("{{route('delete-category')}}", {
                'id': delete_id
            , })
            .then(res => {
                console.log(res);
                window.location.reload()
            }).catch(error => {
                console.error(error);
            });
    });

</script>
@endsection
