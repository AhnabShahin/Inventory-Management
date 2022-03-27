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
                <form action="{{route('updateProductDetails',[$product->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="title" class="form-control" value="{{$product->title}}" id="title" placeholder="Title">
                        <label for="title">Title</label>
                        @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="category_id" name="category_id" aria-label="Floating label select example">
                            <option value={{Null}}>Select category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" {{ $product->category_id == $category->id ? 'selected' : ''  }}>{{$category->name}}</option>
                            @endforeach
                        </select>
                        <label for="category_id">Select Category For Product</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="brand" value="{{$product->brand}}" class="form-control" id="brand" placeholder="Brand Name">
                        <label for="brand">Brand Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Product summary" name="summary" id="summary" style="height: 100px;">{{$product->summary}}</textarea>
                        <label for="address">Product summary</label>
                    </div>
                    <div class="mb-3">
                        <label for="images" class="form-label">Product Images</label>
                        <input class="form-control" name="images[]" type="file" id="images" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Now !!</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')