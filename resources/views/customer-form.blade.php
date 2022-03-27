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
                <h6 class="mb-4">Register New Customer</h6>
                <form action="{{ route('saveCustomer') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name">
                        <label for="first_name">First Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="middle_name" class="form-control" id="middle_name" placeholder="Middle Name">
                        <label for="middle_name">Middle Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name">
                        <label for="last_name">Last Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="mobile" class="form-control" id="mobile" placeholder="Phone number">
                        <label for="mobile">Mobile Number</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email address">
                        <label for="mobile">Email</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a intro here" name="intro" id="intro" style="height: 100px;"></textarea>
                        <label for="intro">Customer Intro</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave Address here" name="address" id="address" style="height: 100px;"></textarea>
                        <label for="address">Customer Asddress</label>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Image</label>
                        <input class="form-control" type="file" name="image" id="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Register Now !!</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')