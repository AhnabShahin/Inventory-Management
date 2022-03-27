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
            <div class="bg-light rounded h-100 p-4">
                <h5 class="mb-4 text-primary">Sell Details</h5>
                <dl class="row mb-0">
                    <div class="col-sm-12 col-xl-12">
                        <div class="table-responsive mb-3">
                            <table class="table text-center align-middle table-bordered table-hover ">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col" style="white-space: nowrap">Color</th>
                                        <th scope="col" style="white-space: nowrap">Size</th>
                                        <th scope="col" style="white-space: nowrap">Quantity</th>
                                        <th scope="col" style="white-space: nowrap">Unit Buying Price</th>
                                        <th scope="col" style="white-space: nowrap">Unit Selling Price</th>
                                        <th scope="col" style="white-space: nowrap">Profit Per Unit</th>
                                        <th scope="col" style="white-space: nowrap">Total Buying Price</th>
                                        <th scope="col" style="white-space: nowrap">Total selling Price</th>
                                        <th scope="col" style="white-space: nowrap">Total Profit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sell_details->orders as $order)
                                    <tr>
                                        <td>{{$order->color}}</td>
                                        <td>{{$order->size}}</td>
                                        <td>{{$order->quantity}}</td>
                                        <td>{{$order->unit_buying_price}}</td>
                                        <td>{{$order->unit_selling_price}}</td>
                                        <td>{{$order->unit_profit}}</td>
                                        <td>{{$order->total_buying_price}}</td>
                                        <td>{{$order->total_selling_price}}</td>
                                        <td>{{$order->total_profit}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <dt class="col-sm-4">Sell Code</dt>
                    <dd class="col-sm-8">{{$sell_details->sell_id}}</dd>

                    <dt class="col-sm-4">Selling Price Before Discount</dt>
                    <dd class="col-sm-8">{{$sell_details->sell_price_before_discount}}</dd>

                    <dt class="col-sm-4">Discount</dt>
                    <dd class="col-sm-8">{{$sell_details->discount}}</dd>

                    <dt class="col-sm-4">Selling Price After Discount</dt>
                    <dd class="col-sm-8">{{$sell_details->sell_price_after_discount}}</dd>

                    <dt class="col-sm-4">Profit Margin</dt>
                    <dd class="col-sm-8">{{$sell_details->profit_margin}}</dd>

                    <dt class="col-sm-4">Delivery Address</dt>
                    <dd class="col-sm-8">{{$sell_details->delivery_Address?$sell_details->delivery_Address:'None'}}</dd>

                    <dt class="col-sm-4">Payment Type</dt>
                    <dd class="col-sm-8">{{$sell_details->payment_type?$sell_details->payment_type:'None'}}</dd>
                </dl>
                <h5 class="mt-4 text-primary">Customer Details</h5>
                <dl class="row mb-0">
                    <dt class="col-sm-4">Customer Code</dt>
                    <dd class="col-sm-8">{{$sell_details->customer->customer_id}}</dd>

                    <dt class="col-sm-4">First Name</dt>
                    <dd class="col-sm-8">{{$sell_details->customer->first_name?$sell_details->customer->first_name:'None'}}</dd>

                    <dt class="col-sm-4">Middle Name</dt>
                    <dd class="col-sm-8">{{$sell_details->customer->middle_name?$sell_details->customer->middle_name:'None'}}</dd>

                    <dt class="col-sm-4">Last Name</dt>
                    <dd class="col-sm-8">{{$sell_details->customer->last_name?$sell_details->customer->last_name:'None'}}</dd>

                    <dt class="col-sm-4">Mobile Number</dt>
                    <dd class="col-sm-8">{{$sell_details->customer->mobile?$sell_details->customer->mobile:'None'}}</dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">{{$sell_details->customer->email?$sell_details->customer->email:'None'}}</dd>

                    <dt class="col-sm-4">Intro</dt>
                    <dd class="col-sm-8">{{$sell_details->customer->intro?$sell_details->customer->intro:'None'}}</dd>

                    <dt class="col-sm-4">Address</dt>
                    <dd class="col-sm-8">{{$sell_details->customer->address?$sell_details->customer->address:'None'}}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')