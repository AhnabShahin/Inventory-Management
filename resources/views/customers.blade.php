@include('layouts.header')
<div class="container-fluid pt-4 px-4 ">
    @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-circle me-2"></i> {{ session()->get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-circle me-2"></i> {{ session()->get('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row g-3">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">All Customer Details</h6>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">Customer ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Email</th>
                                <th scope="col">Registered On</th>
                                <th scope="col">View</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                            <tr>
                                <td>{{$customer->customer_id}}</td>
                                <td>{{$customer->first_name}}</td>
                                <td>{{$customer->mobile}}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{$customer->created_at}}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="">View</a>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{route('getCustomer',[$customer->id])}}">Edit</a>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{(route('deleteCustomer',[$customer->id]))}}">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')