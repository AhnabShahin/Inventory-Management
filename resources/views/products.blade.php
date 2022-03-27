@include('layouts.header')
<div class="container-fluid pt-4 px-4">
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
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">All Products</h6>
                </div>
                <div class="table-responsive">
                    <table class="table text-center align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">Product Id</th>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Attributes</th>
                                <th scope="col">Total Quantity</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            @php
                            $total_quantity = 0;
                            @endphp
                            <tr>
                                <td style="white-space: nowrap">{{$product->product_id}}</td>
                                <td>{{$product->title}}</td>
                                <td>
                                    @if(isset($product->category->name))
                                    {{$product->category->name}}
                                    @endif
                                </td>
                                <td>
                                    @if(!$product->product_attributes->isEmpty())
                                    <table class="table text-center align-middle table-bordered table-hover mb-0">
                                        <thead>
                                            <tr class="text-dark">
                                                <th scope="col">Color</th>
                                                <th scope="col">Size</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Unit Price</th>
                                                <th scope="col">Add to Cart</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($product->product_attributes as $attributes)
                                            <tr>
                                                <td>{{$attributes->color}}</td>
                                                <td>{{$attributes->size}}</td>
                                                <td>{{$attributes->quantity}}</td>
                                                <td>{{$attributes->unit_price}}</td>
                                                <td>
                                                    <form class="d-flex align-items-center" action="{{route('addToCart',[$attributes->id])}}" method="POST">
                                                        @csrf
                                                        <input type="number" name="quantity" style="width: 5rem;" class="form-control form-control-sm me-1" onKeyUp="if(this.value>{{$attributes->quantity}}) this.value=null;" min="1" max="{{$attributes->quantity}}">
                                                        <button type="submit" class="btn btn-sm btn-primary">Add</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" href="{{route('getProductAttribute',[$attributes->id])}}">Edit</a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" href="{{route('deleteProductAttribute',[$attributes->id])}}">Delete</a>
                                                </td>
                                            </tr>
                                            @php
                                            $total_quantity +=$attributes->quantity;
                                            @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                </td>
                                <td>{{$total_quantity}}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{route('getProduct',[$product->id])}}">Edit</a>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{route('deleteProduct',[$product->id])}}">Delete</a>
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