@extends('layout')

@section('content')

<!--End color Modal -->
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Product</h5>

            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Name</label>
                        <input type="text" value="{{$product->name}}" readonly class="form-control" id="basic-default-fullname" placeholder="John Doe">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-message">Description</label>
                        <textarea readonly id="basic-default-message" class="form-control" placeholder="{{$product->description}}"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Price</label>
                        <input type="text" value="{{$product->price}}" readonly class="form-control" id="basic-default-fullname" placeholder="John Doe">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Star Avg</label>
                        @if(!empty($product->star_avg))
                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            @for($i=1;$i<=$product->star_avg;$i++)
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Lilian Fuller">
                                    <i class='bx bxs-star' style="color:yellow" aria-hidden="true"></i>
                                </li>
                                @endfor
                        </ul>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Category</label>
                        <input type="text" value="{{$product->category->name}}" readonly class="form-control" id="basic-default-fullname" placeholder="John Doe">
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Product Detail</h5>

            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Color</label>
                        <select class="form-select" id="color" aria-label="Default select example">
                            <option>Chọn màu</option>
                            @foreach($listColor as $detail)
                            <option value="{{$detail->colors_id}}">{{$detail->color[0]->name}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Size</label>
                        <select class="form-select" id="size" aria-label="Default select example">
                            <option>Chọn size</option>
                            @foreach($listSize as $detail)
                            <option value="{{$detail->sizes_id}}">{{$detail->size[0]->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Quantity</label>
                        <input type="text" name="quantity" id="quantity" readonly class="form-control" id="basic-default-fullname">
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/jquery-3.7.1.min.js')}}"></script>
<script>
    var $j = jQuery.noConflict();
    $j(document).ready(function() {
        $j('select#color, select#size').change(function() {
            var colorId = $j('select#color').val();
            var sizeId = $j('select#size').val();
            console.log(colorId, sizeId)
            $j.ajax({
                url: "{{ route('product.quantity', ['id' => $product->id]) }}",
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'color_id': colorId,
                    'size_id': sizeId
                },

                success: function(data) {
                    $j('#quantity').val(data.quantity);

                    console.log(data);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

<!-- @endsection -->