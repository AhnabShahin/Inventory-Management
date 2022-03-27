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
    <form action="{{ route('sell') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            @foreach($card_items as $key=>$card_item)
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Item #{{$key+1}}</h6>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Product Code</dt>
                        <dd class="col-sm-8">{{$card_item->product->product_id}}</dd>

                        <dt class="col-sm-4">Category</dt>
                        <dd class="col-sm-8">{{$card_item->product->category->name}}</dd>

                        <dt class="col-sm-4"> Title</dt>
                        <dd class="col-sm-8">{{$card_item->product->title}}</dd>

                        <dt class="col-sm-4"> Brand</dt>
                        <dd class="col-sm-8">{{$card_item->product->brand}}</dd>

                        <dt class="col-sm-4"> Color</dt>
                        <dd class="col-sm-8">{{$card_item->color}}</dd>

                        <dt class="col-sm-4"> Size</dt>
                        <dd class="col-sm-8">{{$card_item->size}}</dd>

                        <dt class="col-sm-4"> Quantity</dt>
                        <dd class="col-sm-8">{{$card_item->quantity}}</dd>

                        <dt class="col-sm-4"> Unit Price</dt>
                        <dd class="col-sm-8">{{$card_item->product_attribute->unit_price}}</dd>

                        <dt class="col-sm-4"> Unit Selling Price</dt>
                        <dd class="col-sm-8">
                            <input type="number" name="unit_selling_price[]" class="form-control form-control-sm " id="unit_selling_price" placeholder="Selling Price">
                            @if ($errors->has('unit_selling_price.'.$key))
                            <span class="text-danger">This field is required</span>
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>
            @endforeach
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <div class="mb-3">
                        <label for="customer_id">Select Customer Of those Orders</label>
                        <select class="form-select" id="customer_id" name="customer_id" aria-label="Floating label select example">
                            <option value={{Null}}>Select Customer</option>
                            @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->customer_id}} - {{$customer->first_name}} - {{$customer->mobile}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('customer_id'))
                        <span class="text-danger">{{ $errors->first('customer_id') }}</span>
                        @endif
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Delivery Address " name="delivery_address" id="delivery_address" style="height: 100px;"></textarea>
                        <label for="delivery_address">Product Delivery Address</label>
                    </div>
                    <div class="form mb-3">
                        <label for="discount">Discount Amount On Total Bill</label>
                        <input class="form-control"  type="number" placeholder="0" name="discount" id="discount">
                    </div>
                    <div class="mb-3">
                        <label for="payment_type">Payment Type</label>
                        <select class="form-select" id="payment_type" name="payment_type" aria-label="Floating label select example">
                            <option value={{Null}}>Select Payment Type</option>
                            <option value="Hand Cash">Hand Cash</option>
                            <option value="Bkash">Bkash</option>
                            <option value="Nogod">Nogod</option>
                            <option value="Rocket">Rocket</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Sell Now !!</button>
                </div>
            </div>
        </div>
    </form>
</div>

@include('layouts.footer')