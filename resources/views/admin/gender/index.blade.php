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
                        Gender List
                        <a href="{{ url('admin/gender/create') }}" class="btn btn-primary btn-sm text-white float-end">Add Gender</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($genders as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>

                                <td>
                                    @if($item->image)
                                        <img src="{{ asset($item->image) }}" alt="Gender Image" width="100">
                                    @else
                                        No Image
                                    @endif
                                </td>

                                <td>{{ $item->slug }}</td>


                                <td>
                                    <a href="{{ url('admin/gender/edit/'.$item->id) }}" class="btn btn-success btn-sm">
                                        Edit
                                    </a>
                                    <a onclick="return confirm('Are you sure to Delete?');"  href="{{ url('admin/gender/delete/'.$item->id) }}" class="btn btn-danger btn-sm">
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
