<!-- Add Product Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>

                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createForm" action="" method="post">
                    <div class="row">
                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-name">Name</label>
                                        <input type="text" name="name" class="form-control" id="basic-default-name" placeholder="John Doe">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-description">Description</label>
                                        <input type="text" name="description" class="form-control" id="basic-default-description" placeholder="mô tả">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-price">Price</label>
                                        <input type="text" name="price" class="form-control" id="basic-default-price" placeholder="ACME Inc.">
                                    </div>
                                    <div class="mb-3">
                                        <label for="selectCategories" class="form-label">Categories</label>
                                        <select class="form-select" name="categories_id" id="selectCategories" aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                            @if(!empty($listCategory))
                                            @foreach($listCategory as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="formFileMultiple" class="form-label">Multiple Image</label>
                                        <input class="form-control" type="file" id="formFileMultiple" name="images[]" multiple="">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="selectColors" class="form-label">Colors</label>
                                        <div class="d-flex align-items-center">
                                            <select class="form-select" name="colors_id" id="selectColors" aria-label="Default select example">
                                                <option selected="">Open this select menu</option>
                                                @if(!empty($listColor))
                                                @foreach($listColor as $color)
                                                <option value="{{$color->id}}">{{$color->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <button type="button" class="btn btn-icon btn-outline-secondary ms-2" data-bs-toggle="modal" data-bs-target="#addColorModal">
                                                <span class="bx bx-palette"></span>
                                            </button>
                                        </div>

                                    </div>
                                    <div class="mb-3">
                                        <label for="selectSizes" class="form-label">Sizes</label>
                                        <div class="d-flex align-items-center">
                                            <select class="form-select" name="sizes_id" id="selectSizes" aria-label="Default select example">
                                                <option selected="">Open this select menu</option>
                                                @if(!empty($listSize))
                                                @foreach($listSize as $size)
                                                <option value="{{$size->id}}">{{$size->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <button type="button" class="btn btn-icon btn-outline-secondary ms-2" data-bs-toggle="modal" data-bs-target="#addSizeModal">
                                                <span class="bx bx-ruler"></span>
                                            </button>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnCreateProduct" onclick="resetPagination()">Create Product</button>
            </div>
        </div>
    </div>
</div>
<!-- End Add Product Modal -->
<!-- Update Product Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">update Product</h5>

                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateForm" action="" method="post">
                    <div class="row">
                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="John Doe">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="description">Description</label>
                                        <input type="text" name="description" class="form-control" id="description" placeholder="mô tả">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="price">Price</label>
                                        <input type="text" name="price" class="form-control" id="price" placeholder="ACME Inc.">
                                    </div>
                                    <div class="mb-3">
                                        <label for="categories" class="form-label">Categories</label>
                                        <select class="form-select" name="categories_id" id="categories" aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                            @if(!empty($listCategory))
                                            @foreach($listCategory as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>

                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div id="imageContainer" class="h-25 d-flex flex-wrap">
                                        <!-- container image -->
                                    </div>
                                    <button type="button" class="btn rounded-pill btn-primary mt-3" id="btnDeleteImage">
                                        Del
                                    </button>
                                    <div class="mb-3">
                                        <label for="images" class="form-label">Multiple Image</label>
                                        <input class="form-control" type="file" id="images" name="images[]" multiple="">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnUpdateProduct">Update Product</button>
            </div>
        </div>
    </div>
</div>
<!-- End Update Product Modal -->
<!--Add color Modal -->
<div class="modal fade" id="addColorModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameWithTitle" class="form-label">Name</label>
                        <input type="text" id="nameWithTitle" class="form-control" placeholder="Enter Name">
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-0">
                        <label for="emailWithTitle" class="form-label">Email</label>
                        <input type="text" id="emailWithTitle" class="form-control" placeholder="xxxx@xxx.xx">
                    </div>
                    <div class="col mb-0">
                        <label for="dobWithTitle" class="form-label">DOB</label>
                        <input type="text" id="dobWithTitle" class="form-control" placeholder="DD / MM / YY">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!--End color Modal -->