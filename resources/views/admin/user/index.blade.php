@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col md-12">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>User
                        <a href="{{ url('admin/user/create') }}" class="btn btn-primary btn-sm text-white float-end">Add User</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{$item->name}}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @if($item->role_as == '0')
                                        <label class="badge btn-primary">user</label>
                                    @elseif($item->role_as = '1')
                                        <label class="badge btn-primary">admin</label>
                                    @else
                                        <label class="badge btn-primary">none</label>
                                    @endif
                                </td>
                                <td>{{ $item->created_at}}</td>
                                <td>
                                    <a href="{{ url('admin/user/edit/'.$item->id) }}" class="btn btn-success btn-sm">
                                        Edit
                                    </a>

                                    <a href="{{ url('admin/user/delete/'.$item->id) }}" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger btn-sm">
                                        Delete
                                    </a>

                                    <a href="{{url('admin/user/password/'.$item->id)}}" class="btn btn-inverse-primary btn-sm">
                                        Password Change
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

                </div>
            </div>
        </div>
    </div>

@endsection
