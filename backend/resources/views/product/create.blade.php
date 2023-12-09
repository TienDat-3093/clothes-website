@extends('layout')

@section('content')
<div class="row">
</div>
<div class="col-xl">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Add Product</font>
                </font>
            </h5>
            
        </div>
        <div class="card-body">
            <form action="{{route('product.createHandle')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Name</font>
                        </font>
                    </label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                    </div>
                </div>
                <div class="form-text">
                    <font style="vertical-align: inherit;">
                        @error('name')
                        <font style="vertical-align: inherit;color:red">{{ $message }}</font>
                        @enderror
                    </font>

                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-message">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Description</font>
                        </font>
                    </label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-comment"></i></span>
                        <input name="description" value="{{ old('description') }}" id="basic-icon-default-message" class="form-control" placeholder="Nhập địa chỉ" aria-label="Nhập địa chỉ" aria-describedby="basic-icon-default-message2"></input>

                    </div>
                </div>
                <div class="form-text">
                    <font style="vertical-align: inherit;">
                        @error('description')
                        <font style="vertical-align: inherit;color:red">{{ $message }}</font>
                        @enderror
                    </font>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Import Price</font>
                        </font>
                    </label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                        <input type="text" name="import_price" value="{{ old('import_price') }}" class="form-control" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                    </div>
                </div>
                <div class="form-text">
                    <font style="vertical-align: inherit;">
                        @error('import_price')
                        <font style="vertical-align: inherit;color:red">{{ $message }}</font>
                        @enderror
                    </font>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Sales Price</font>
                        </font>
                    </label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                        <input type="text" name="sales_price" value="{{ old('sales_price') }}" class="form-control" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                    </div>
                </div>
                <div class="form-text">
                    <font style="vertical-align: inherit;">
                        @error('sales_price')
                        <font style="vertical-align: inherit;color:red">{{ $message }}</font>
                        @enderror
                    </font>

                </div>

                





                
                
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="{{route('supplier.index')}}" class="btn btn-outline-secondary">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>
</div>
@endsection