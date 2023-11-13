@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>
                        Brand List
                        <a href="{{ url('admin/brand/create') }}" class="btn btn-primary btn-sm text-white float-end">Add Brand</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>

                                <td>
                                    @if($brand->image)
                                        <img src="{{ asset($brand->image) }}" alt="Brand Image" width="100">
                                    @else
                                        No Image
                                    @endif
                                </td>

                                <td>
                                    @if($brand->category)
                                        {{ $brand->category->name }}
                                    @else
                                        No Category
                                    @endif
                                </td>
                                <td>{{ $brand->slug }}</td>
                                <td>{{ $brand->status == '1' ? 'hidden':'visible' }}</td>

                                <td>
                                    <a href="{{ url('admin/brand/edit/'.$brand->id) }}" class="btn btn-success btn-sm">
                                        Edit
                                    </a>
                                    <a onclick="return confirm('Are you sure to Delete?');"  href="{{ url('admin/brand/delete/'.$brand->id) }}" class="btn btn-danger btn-sm">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

{{--                    <div>--}}
{{--                        {{ $brand->links() }}--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>

@endsection
