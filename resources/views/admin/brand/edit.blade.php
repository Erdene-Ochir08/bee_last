@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Edit Brand
                        <a href="{{ url('admin/brands') }}" class="btn btn-danger btn-sm text-white float-end">BACK</a>
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
                    <form action="{{ url('admin/brand/'.$brand->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="mb-3">
                                <label for="category_id">Category</label>

                                <select name="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $brand->category_id ? 'selected':'' }} >
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="name">Brand Name</label>
                                <input type="text" name="name" class="form-control" value="{{$brand->name}}">
                            </div>

                            <div class="mb-3">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control"><br>
                                <img src="{{ asset("$brand->image") }}" height="100px" width="100px" alt="image">
                            </div>

                            <div class="mb-3">
                                <label for="status">Status</label>
                                <input type="checkbox" name="status" {{ $brand->status == '1' ? 'checked':'' }} >
                                (Checked = Hidden, Unchecked = Visible)
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary btn-sm float-end">UPDATE</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
