@extends('layout')

@section('content')
    <div class="row">
    </div>
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Add Import</font>
                    </font>
                </h5>

            </div>
            <div class="card-body">

                <!-- Supplier -->
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Supplier</font>
                        </font>
                    </label>
                    <select id="supplier" name="suppliers_id" class="form-select" aria-label="Default select example">
                        @foreach ($listSuppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Product -->
                <label class="form-label" for="basic-icon-default-fullname">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Products</font>
                    </font>
                </label>
                <select id="product" class="form-select" id="exampleFormControlSelect1"
                    aria-label="Default select example">
                    @foreach ($listProducts as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>

                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Colors</font>
                </font>
                </label>
                <select id="color" class="form-select" id="exampleFormControlSelect1"
                    aria-label="Default select example">
                    @foreach ($listColors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                </select>

                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Size</font>
                </font>
                </label>
                <select id="size" class="form-select" id="exampleFormControlSelect1"
                    aria-label="Default select example">
                    @foreach ($listSizes as $size)
                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                    @endforeach
                </select>

                <div class="mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-icon-default-name">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Số lượng</font>
                        </font>
                    </label>
                    <div class="col-sm-100">
                        <input type="number" id="quantity" class="form-control" placeholder=" " />
                    </div>
                </div>

                <div class="mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-icon-default-name">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Giá nhập</font>
                        </font>
                    </label>
                    <div class="col-sm-100">
                        <input type="number" id="price" class="form-control" placeholder=" " />
                    </div>
                </div>
                <button id="add-button" type="button" class="btn btn-primary me-2" onclick="productUpdate()">Add</button>
                <form action="{{ route('import.create-handle') }}" method="post">
                    <br>
                    @csrf
                    <label for="basic-icon-default-name">Supplier: </label><b id="supplier-alt-name">
                        {{ $listSuppliers[0]->name }}</b>
                    <input type="hidden" name="supplier_id" id="supplier-alt" value='1' />
                    <table id="productTable" class="table">
                        <tbody>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Màu</td>
                                <td>Kích cỡ</td>
                                <td>Số lượng</td>
                                <td>Giá nhập</td>
                                <td>Thành tiền</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('import.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>
    <script src="{{ asset('assets/jquery-3.7.1.min.js') }}"></script>
    <script>
        $("#supplier").change(function() {
            $('#supplier-alt').val(this.value);
            $('#supplier-alt-name').text($(this).find('option[value="' + this.value + '"]').text());
        });

        function add_button_check() {
            var productId = $("#product").find(":selected").val();
            var colorId = $("#color").find(":selected").val();
            var sizeId = $("#size").find(":selected").val();
            var matchingRows = $('tr:has(td #color-id[value="' + colorId + '"])')
                .filter(':has(td #size-id[value="' + sizeId + '"])')
                .filter(':has(td #product-id[value="' + productId + '"])');
            if (matchingRows.length > 0) {
                $('#add-button').text('Edit');
            } else {
                $('#add-button').text('Add');
            }
        }
        $("#product").change(function() {
            add_button_check();
        });
        $("#color").change(function() {
            add_button_check();
        });
        $("#size").change(function() {
            add_button_check();
        });

        function productUpdate() {
            if ($("#quantity").val() != "" && $("#price").val() != "" && $("#color").val() != "" && $("#size").val() !=
                "") {
                productsAdd();
                formClear();
                add_button_check();
            }
        }

        function formClear() {
            $("#quantity").val("");
            $("#price").val("");
            $("#product").val("");
            $("#color").val("");
            $("#size").val("");
        }

        function productDelete(ctl) {
            $(ctl).parents('tr').remove();
            add_button_check();
        }

        function productEdit(ctl) {
            if ($("#quantity").val() != "" && $("#price").val() != "" && $("#color").val() != "" && $("#size").val() !=
                "") {
                var colorId = $("#color").find(":selected").val();
                var sizeId = $("#size").find(":selected").val();
                var color = $("#color").find(":selected").text();
                var size = $("#size").find(":selected").text();
                var price = $("#price").val();
                var quantity = $("#quantity").val();
                var product = $("#product").find(":selected").text();
                var productId = $("#product").find(":selected").val();
                var totalprice = price * quantity;
                $(ctl).after(`<tr> 
        <td>${product}<input type="hidden" name="product_id[]" id="product-id" value="${productId}"/></td>
        <td>${color}<input type="hidden" name="color[]" id="color-id" value="${colorId}"/></td>
        <td>${size}<input type="hidden" name="size[]" id="size-id" value="${sizeId}"/></td>
        <td>${quantity}<input type="hidden" name="quantity[]" value="${quantity}"/></td>
        <td>${price}<input type="hidden" name="price[]" value="${price}"/></td>
        <td>${totalprice}<input type="hidden" name="totalprice[]" value="${totalprice}"/></td>
        <td>
            <button type='button'onclick='productDelete(this);'class='btn btn-default'>
            <span class='glyphicon glyphicon-remove' />
            Delete
            </button>
        </div>
        </td>
        </tr>`);
                productDelete(ctl.find('td'));
                formClear();
                add_button_check();
            }
        }

        function productsAdd() {
            var colorId = $("#color").find(":selected").val();
            var sizeId = $("#size").find(":selected").val();
            var color = $("#color").find(":selected").text();
            var size = $("#size").find(":selected").text();
            var price = $("#price").val();
            var quantity = $("#quantity").val();
            var product = $("#product").find(":selected").text();
            var productId = $("#product").find(":selected").val();
            var totalprice = price * quantity;
            var $productElement = $('#product-id[value="' + productId + '"]');
            var $colorElement = $('#color-id[value="' + colorId + '"]');
            var $sizeElement = $('#size-id[value="' + sizeId + '"]');
            var matchingRows = $('tr:has(td #color-id[value="' + colorId + '"])')
                .filter(':has(td #size-id[value="' + sizeId + '"])')
                .filter(':has(td #product-id[value="' + productId + '"])');

            if (matchingRows.length > 0) {
                productEdit(matchingRows);
            } else {
                $("#productTable tbody").append(`<tr> 
        <td>${product}<input type="hidden" name="product_id[]" id="product-id" value="${productId}"/></td>
        <td>${color}<input type="hidden" name="color[]" id="color-id" value="${colorId}"/></td>
        <td>${size}<input type="hidden" name="size[]" id="size-id" value="${sizeId}"/></td>
        <td>${quantity}<input type="hidden" name="quantity[]" value="${quantity}"/></td>
        <td>${price}<input type="hidden" name="price[]" value="${price}"/></td>
        <td>${totalprice}<input type="hidden" name="totalprice[]" value="${totalprice}"/></td>
        <td>
            <button type='button'onclick='productDelete(this);'class='btn btn-default'>
            <span class='glyphicon glyphicon-remove' />
            Delete
            </button>
        </div>
        </td>
        </tr>`);
            }
        }
    </script>
@endsection
