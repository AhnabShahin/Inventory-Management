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
        <div class="col-sm-12 col-xl-4">
            <div class="h-100 bg-light rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Create Category</h6>
                </div>
                <form class="d-flex mb-2" method="post" action="{{route('saveCategory')}}">
                    @csrf
                    <input class="form-control bg-transparent" name="name" type="text" placeholder="Enter task">
                    <button type="submit" class="btn btn-primary ms-2">Add</button>
                </form>

                @foreach($categories as $category)
                <div class="d-flex align-items-center border-bottom py-2">
                    <!-- <input class="form-check-input m-0" type="checkbox"> -->
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <span>{{$category['name']}}</span>
                            <a href="{{ route('deleteCategory', [$category['id']]) }}" class="btn btn-sm"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
        <div class="col-sm-12 col-xl-8">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Entry New Product</h6>
                <form action="{{ route('saveProduct') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                        <label for="title">Title</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="category_id" name="category_id" aria-label="Floating label select example">
                            <option value={{Null}}>Select category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <label for="category_id">Select Category For Product</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="brand" class="form-control" id="brand" placeholder="Brand Name">
                        <label for="brand">Brand Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Product summary" name="summary" id="summary" style="height: 100px;"></textarea>
                        <label for="address">Product summary</label>
                    </div>
                    <div class="mb-3">
                        <label for="images" class="form-label">Product Images</label>
                        <input class="form-control" name="images[]" type="file" id="images" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Now !!</button>
                </form>
            </div>
        </div>
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Entry Product Attributes</h6>
                <form action="{{ route('saveProductAttribute') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="product_id">Select Product For Set Attributes</label>
                        <select class="form-select " id="product_id" name="product_id">
                            <option value={{Null}}>Select product</option>
                            @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->product_id}} <span> -- {{$product->title}} </span></option>
                            @endforeach
                        </select>
                        @if ($errors->has('product_id'))
                        <span class="text-danger">{{ $errors->first('product_id') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="color">Product Color</label>
                        <input type="text" name="color" class="form-control" id="color" placeholder="Exm : Green">
                        @if ($errors->has('color'))
                        <span class="text-danger">{{ $errors->first('color') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="size">Product Size</label>
                        <input type="text" name="size" class="form-control" id="size" placeholder="Exm : XL">
                        @if ($errors->has('size'))
                        <span class="text-danger">{{ $errors->first('size') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" min="1" placeholder="Quantity">
                        @if ($errors->has('quantity'))
                        <span class="text-danger">{{ $errors->first('quantity') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="unit_price">Single Unit Price</label>
                        <input type="number" step="any" name="unit_price" class="form-control" id="quantity" min="0" placeholder="Price">
                        @if ($errors->has('unit_price'))
                        <span class="text-danger">{{ $errors->first('unit_price') }}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Add Now !!</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')