@extends('layout')

@section('content')
<div class="row">
</div>
<div class="col-xl">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Add Supplier</font>
                </font>
            </h5>
            
        </div>
        <div class="card-body">
            <form action="{{route('supplier.createHandle')}}" method="post">
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
                    <label class="form-label" for="basic-icon-default-email">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">E-mail</font>
                        </font>
                    </label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                        <input type="text" name="email" value="{{ old('email') }}" id="basic-icon-default-email" class="form-control" placeholder="john.doe" aria-label="john.doe" aria-describedby="basic-icon-default-email2">
                        <span id="basic-icon-default-email2" class="input-group-text">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">@company.com</font>
                            </font>
                        </span>
                    </div>
                    <div class="form-text">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Bạn có thể sử dụng chữ cái, số và dấu chấm</font>
                        </font>
                    </div>
                </div>
                <div class="form-text">
                    <font style="vertical-align: inherit;">
                        @error('email')
                        <font style="vertical-align: inherit;color:red">{{ $message }}</font>
                        @enderror
                    </font>

                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-phone">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Phone-number</font>
                        </font>
                    </label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                        <input type="text" name="phone_number" value="{{ old('phone_number') }}" id="basic-icon-default-phone" class="form-control phone-mask" placeholder="038 799 8941" aria-label="038 799 8941" aria-describedby="basic-icon-default-phone2">

                    </div>

                </div>
                <div class="form-text">
                    <font style="vertical-align: inherit;">
                        @error('phone_number')
                        <font style="vertical-align: inherit;color:red">{{ $message }}</font>
                        @enderror
                    </font>

                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-message">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Address</font>
                        </font>
                    </label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-comment"></i></span>
                        <input name="address" value="{{ old('address') }}" id="basic-icon-default-message" class="form-control" placeholder="Nhập địa chỉ" aria-label="Nhập địa chỉ" aria-describedby="basic-icon-default-message2"></input>

                    </div>
                </div>
                <div class="form-text">
                    <font style="vertical-align: inherit;">
                        @error('address')
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