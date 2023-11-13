@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col md-12">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>SIZE
                        <a href="{{ url('admin/size/create') }}" class="btn btn-primary btn-sm text-white float-end">Add Size</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($sizes as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{$item->name}}</td>

                                <td>{{ $item->created_at}}</td>
                                <td>
                                    <a href="{{ url('admin/size/edit/'.$item->id) }}" class="btn btn-success btn-sm">
                                        Edit
                                    </a>

                                    <a href="{{ url('admin/size/delete/'.$item->id) }}" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger btn-sm">
                                        Delete
                                    </a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No Size Available</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection
