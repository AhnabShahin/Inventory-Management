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
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Update Product Details</h6>
                <form action="{{route('updateProductAttribute',[$productAttribute->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="color">Product Color</label>
                        <input type="text" name="color" value="{{$productAttribute->color}}" class="form-control" id="color" placeholder="Exm : Green">
                        @if ($errors->has('color'))
                        <span class="text-danger">{{ $errors->first('color') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="size">Product Size</label>
                        <input type="text" name="size" value="{{$productAttribute->size}}" class="form-control" id="size" placeholder="Exm : XL">
                        @if ($errors->has('size'))
                        <span class="text-danger">{{ $errors->first('size') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" value="{{$productAttribute->quantity}}" class="form-control" id="quantity" min="1" placeholder="Quantity">
                        @if ($errors->has('quantity'))
                        <span class="text-danger">{{ $errors->first('quantity') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="unit_price">Single Unit Price</label>
                        <input type="number" step="any" value="{{$productAttribute->unit_price}}" name="unit_price" class="form-control" id="quantity" min="0" placeholder="Price">
                        @if ($errors->has('unit_price'))
                        <span class="text-danger">{{ $errors->first('unit_price') }}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Update Now !!</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')