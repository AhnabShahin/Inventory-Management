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
                    <h6 class="mb-0">All Sells Details</h6>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col" style="white-space: nowrap">Sell ID</th>
                                <th scope="col" style="white-space: nowrap">Items On sell</th>
                                <th scope="col" style="white-space: nowrap">Selling Price</th>
                                <th scope="col" style="white-space: nowrap">Discount</th>
                                <th scope="col" style="white-space: nowrap">Payment Type</th>
                                <th scope="col" style="white-space: nowrap">Invoice Download</th>
                                <th scope="col" style="white-space: nowrap">More Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sells as $sell)
                            <tr>
                                <td style="white-space: nowrap">{{$sell->sell_id}}</td>
                                <td>
                                    @if(!$sell->orders->isEmpty())
                                    <table class="table text-center align-middle table-bordered table-hover mb-0">
                                        <thead>
                                            <tr class="text-dark">
                                                <th scope="col">Color</th>
                                                <th scope="col">Size</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Unit Selling Price</th>
                                                <th scope="col">Total selling Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($sell->orders as $order)
                                            <tr>
                                                <td>{{$order->color}}</td>
                                                <td>{{$order->size}}</td>
                                                <td>{{$order->quantity}}</td>
                                                <td>{{$order->unit_selling_price}}</td>
                                                <td>{{$order->total_selling_price}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                </td>
                                <td>{{$sell->sell_price_after_discount}}</td>
                                <td>{{$sell->discount}}</td>
                                <td>{{$sell->payment_type}}</td>
                                <td >
                                    <a class="btn btn-sm btn-primary" href="{{route('invoiceDownload',[$sell->id])}}">Invoice</a>
                                </td>
                                <td >
                                    <a class="btn btn-sm btn-primary" href="{{route('sellDetails',[$sell->id])}}">Details</a>
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