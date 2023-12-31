@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col md-12">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Edit Products
                        <a href="{{ url('admin/product') }}" class="btn btn-danger btn-sm text-white float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ url('admin/product/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                                    Home
                                </button>
                            </li>

{{--                            <li class="nav-item" role="presentation">--}}
{{--                                <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag-tab-pane" type="button" role="tab" aria-controls="seotag-tab-pane" aria-selected="false">--}}
{{--                                    Quantity--}}
{{--                                </button>--}}
{{--                            </li>--}}

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="false">
                                    Details
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">
                                    Product Image
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="colors-tab" data-bs-toggle="tab" data-bs-target="#colors-tab-pane" type="button" role="tab">
                                    Product Color
                                </button>
                            </li>


                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="size-tab" data-bs-toggle="tab" data-bs-target="#size-tab-pane" type="button" role="tab" aria-controls="size-tab-pane" aria-selected="false">
                                    Product Size
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                <div class="mb-3">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected':'' }} >
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="brand">Select Brand</label>
                                    <select name="brand" class="form-control">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}" {{ $brand->name == $product->brand ? 'selected':'' }} >
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="gender_id">Gender</label>
                                    <select name="gender_id" class="form-control">
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->id }}" {{ $gender->id == $product->gender_id ? 'selected':'' }} >
                                                {{ $gender->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="mb-3">
                                    <label for="name">Product Name</label>
                                    <input type="text" name="name" value="{{ $product->name }}" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="slug">Product Slug</label>
                                    <input type="text" name="slug" value="{{ $product->slug }}" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="small_description">Small Description (500 Words)</label>
                                    <textarea id="editor2" name="small_description" class="form-control" rows="4">{{ $product->small_description }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea id="editor" name="description" class="form-control" rows="4">{{$product->description}}</textarea>
                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="sale_percent">Sale Percent</label>
                                            <input type="number" name="sale_percent" class="form-control" value="{{ $product->sale_percent}}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="price">Price</label>
                                            <input type="number" name="price" min="1" class="form-control" value="{{ $product->price}}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="price">Quantity</label>
                                            <input type="number" name="quantity" min="1" class="form-control" value="{{ $product->quantity}}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="trending">Trending</label>
                                            <input type="checkbox" name="trending" {{ $product->trending == '1' ? 'checked':'' }} >
                                            (Checked = Hidden, Unchecked = Visible)
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <input type="checkbox" name="status" {{ $product->status == '1' ? 'checked':'' }} >
                                            (Checked = Hidden, Unchecked = Visible)
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                                <div class="mb-3">
                                    <label>Upload Product Image</label><br><br>
                                    <input type="file" class="form-control" name="image[]" multiple />
                                </div>
                                <div>
                                    @if ($product->productImages)
                                        <div class="row">
                                            @foreach ($product->productImages as $image)
                                                <div class="col-md-2">
                                                    <img src="{{ asset($image->image) }}" style="width:80px; height:80px;"  class="me-4 border" alt="image">
                                                    <a href="{{ url('admin/product-image/delete/'.$image->id) }}" class="d-block" >Remove</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        No Image Found
                                    @endif
                                </div>
                            </div>


                            <div class="tab-pane fade border p-3" id="colors-tab-pane" role="tabpanel">
                                <div class="mb-3">
                                    <h4>Add Product Color</h4>
                                    <label>Select Color</label>
                                    <hr>
                                    <div class="row">
                                        @forelse ($colors as $color)
                                            <div class="col-md-3">
                                                <div class="p-2 border mb-3">
                                                    Color: <input type="checkbox" name="colors[{{ $color->id }}]" value="{{ $color->id }}"/>
                                                    {{ $color->name }}
                                                    <br>
                                                    Quantity: <input type="number" name="colorquantity[{{ $color->id }}]" style="width:70px; border: 1px solid;">
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-md-12">
                                                <h1>No Colors Found!</h1>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Color Name</th>
                                            <th>Quantity</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($product->productColors as $productColor)
                                            <tr class="product-color-tr">
                                                <td>
                                                    @if ($productColor->color)
                                                        {{ $productColor->color->name }}
                                                    @else
                                                        No Color Found!
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="input-group mb-3" style="width: 150px;">
                                                        <input type="text" value="{{ $productColor->quantity }}" class="productColorQuantity form-control form-control-sm">
                                                        <button type="submit" value="{{ $productColor->id }}" class="updateProductColorBtn btn btn-primary btn-sm text-white">
                                                            Update
                                                        </button>
                                                    </div>
                                                <td>
                                                    <button type="submit" value="{{ $productColor->id }}" class="deleteProductColorBtn btn btn-danger btn-sm text-white">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                            <div class="tab-pane fade border p-3" id="size-tab-pane" role="tabpanel">
                                <div class="mb-3">
                                    <h4>Add Product Size</h4>
                                    <label>Select Size</label>
                                    <hr>
                                    <div class="row">
                                        @forelse ($sizes as $size)
                                            <div class="col-md-3">
                                                <div class="p-2 border mb-3">
                                                    Size: <input type="checkbox" name="sizes[{{ $size->id }}]" value="{{ $size->id }}"/>
                                                    {{ $size->name }}

                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-md-12">
                                                <h1>No Size Found!</h1>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Size Name</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($product->productSizes as $productSize)
                                            <tr class="product-size-tr">
                                                <td>
                                                    @if ($productSize->size)
                                                        {{ $productSize->size->name }}
                                                    @else
                                                        No Size Found!
                                                    @endif
                                                </td>

                                                <td>
                                                    <button type="submit" value="{{ $productSize->id }}" class="deleteProductSizeBtn btn btn-danger btn-sm text-white">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary float-end">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection


@section('scripts')
    {{--    <script src="{{ asset('admin/js/ckeditor.min.js') }}"></script>--}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );

        ClassicEditor
            .create( document.querySelector( '#editor2' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>


    <script>

        $(document).ready(function (){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.updateProductColorBtn', function (){

                var product_id = "{{ $product->id }}";
                var product_color_id = $(this).val();

                var qty = $(this).closest('.product-color-tr').find('.productColorQuantity').val();

                if(qty <= 0){
                    alert('Quantity is required!');
                    return false;
                }

                var data = {
                    'product_id' : product_id,
                    'qty' : qty
                };

                $.ajax({
                    type: "POST",
                    url: "/admin/product-color/"+product_color_id,
                    data: data,
                    success: function (response) {
                        alert(response.message);
                    }
                });
            });

            $(document).on('click', '.deleteProductColorBtn', function (){

                var product_color_id = $(this).val();
                var thisClick = $(this);

                $.ajax({
                    type: "GET",
                    url: "/admin/product-color/delete/"+product_color_id,
                    success: function (response) {
                        thisClick.closest('.product-color-tr').remove();
                        alert(response.message);
                    }
                });
            });

            $(document).on('click','.deleteProductSizeBtn', function () {
               var product_size_id = $(this).val();
               var thisClick = $(this);

                $.ajax({
                    type: "GET",
                    url: "/admin/product-size/delete/"+product_size_id,
                    success: function (response) {
                        thisClick.closest('.product-size-tr').remove();
                        alert(response.message);
                    }
                });
            });


        });

    </script>
@endsection
