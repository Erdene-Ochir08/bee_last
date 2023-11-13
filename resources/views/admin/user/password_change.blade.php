@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Password Change
                        <a href="{{ url('admin/users') }}" class="btn btn-primary btn-sm text-white float-end">BACK</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/user/password_update/'.$user->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div> {{$user->name}}</div>
                        <div class="row">
                            <div class="form-group">
                                <label>New Password:</label>
                                <input type="password" class="form-control form-control-solid" name="password"
                                       placeholder="New Password" required/>
                                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-group">
                                <label>Verify password</label>
                                <div class="input-group input-group-solid">
                                    <input for="password-confirm" type="password" name="password_confirmation"
                                           class="form-control form-control-solid" placeholder="Verify Password"
                                           required/>
                                    @error('password-confirm') <small
                                        class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
