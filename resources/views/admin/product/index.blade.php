@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col md-12">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Products</h4>
                        </div>
                        <div class="col-md-2">
                            <h4>
                                <a href="{{ url('admin/product/create') }}" class="btn btn-primary btn-md text-white float-end">Add Products</a>
                            </h4>
                        </div>
                        <div class="col-md-2">
                            <div>
                    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-md text-white float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Import Products
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Файлаа оруулна уу</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('product.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="products" required>


              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary text-white float-start">Import Products</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
                </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if ($product->category)
                                        {{ $product->category->name }}
                                    @else
                                        No Category
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->status == '1' ? 'Hidden':'Visible' }}</td>
                                <td>
                                    <a href="{{ url('admin/product/edit/'.$product->id) }}" class="btn btn-success btn-sm text-white">
                                        Edit
                                    </a>
                                    <a href="{{ url('admin/product/delete/'.$product->id) }}" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger btn-sm text-white">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No Products Available</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
