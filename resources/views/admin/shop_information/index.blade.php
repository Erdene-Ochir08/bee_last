@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Site information
                        <a href="{{ url('admin/dashboard') }}" class="btn btn-danger btn-sm text-white float-end">BACK</a>
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
                    <form action="{{ url('admin/client/update/d03a7f43-f1e3-47b0-8a61-21e79df08c7f') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3">
                                <label for="shop_name">Дэлгүүрийн нэр</label>
                                <input type="text" name="shop_name" value="{{ $client->shop_name }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="shop_address">Дэлгүүрийн хаяг</label>
                                <textarea name="shop_address" rows="3" class="form-control">{{ $client->shop_address }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="shop_logo">Logo</label>
                                <input type="file" name="shop_logo" class="form-control" > <br>
                                <img src="{{ asset("$client->shop_logo") }}" height="100px" width="150px" alt="shop_logo">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{$client->email}}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone_number">Утас</label>
                                <input type="number" name="phone_number" class="form-control" value="{{$client->phone_number}}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone_number">Дансны дугаар</label>
                                <input type="number" name="account_number" class="form-control" value="{{$client->account_number}}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone_number">Данс эзэмшигчийн нэр</label>
                                <input type="text" name="account_name" class="form-control" value="{{$client->account_name}}">
                            </div>

                            <div class="mb-3">
                                <label for="working_hour">Ажиллах цаг</label>
                                <input type="text" name="working_hour" value="{{ $client->working_hour }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="google_map_link">Google Map Link</label>
                                <input type="text" name="google_map_link" value="{{ $client->google_map_link }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="facebook_link">Facebook Link</label>
                                <input type="text" name="facebook_link" value="{{ $client->facebook_link }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="instagram_link">Instagram Link</label>
                                <input type="text" name="instagram_link" value="{{ $client->instagram_link }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="youtube_link">YouTube Link</label>
                                <input type="text" name="youtube_link" value="{{ $client->youtube_link }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="twitter_link">Twitter Link</label>
                                <input type="text" name="twitter_link" value="{{ $client->twitter_link }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary btn-sm float-end">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
