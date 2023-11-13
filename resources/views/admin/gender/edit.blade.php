@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Add Gender
                        <a href="{{ url('admin/gender') }}" class="btn btn-danger btn-sm text-white float-end">BACK</a>
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
                    <form action="{{ url('admin/gender/'.$gender->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{$gender->name}}">
                            </div>

                            <div class="mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" class="form-control" value="{{$gender->slug}}">
                            </div>

                            <div class="mb-3">
                                <label for="image">Image</label>
                                <img src="{{ asset("$gender->image") }}" height="100px" width="100px" alt="image">
                                <input type="file" name="image" class="form-control">
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
