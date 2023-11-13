@extends('layouts.admin')

@section('title', 'Homepage')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Өнөөдрийн Захиалгууд
                    </h3>
                </div>
                <div class="card-body">

                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Өдрөөр шүүх</label>
                                <input type="date" name="date" value="{{Request::get('date') ?? date('Y-m-d')}}" class="form-control" />
                            </div>

                            <div class="col-md-3">
                                <label>Төлвөөр шүүх</label>

                                <select name="status" class="form-select">
                                    <option value="">Select All Status</option>
                                    <option value="pending" {{Request::get('status') == 'pending' ? 'selected': ''}}>Pending </option>
                                    <option value="processing" {{Request::get('status') == 'processing' ? 'selected': '' }}>Processing</option>
                                    <option value="declined" {{Request::get('status') == 'declined' ? 'selected': ''}}>Declined</option>
                                    <option value="delivered" {{Request::get('status') == 'delivered' ? 'selected': ''}}>Delivered</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <br>
                                <button type="submit" class="btn btn-primary">FILTER</button>
                            </div>

                        </div>
                    </form>
                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <th>Захиалгийн дугаар</th>
                            <th>Unique number</th>
                            <th>Захиалагчийн нэр</th>
                            <th>Төлбөрийн хэлбэр</th>
                            <th>Захиалсан өдөр</th>
                            <th>Төлөв</th>
                            <th>Захиалга хянах</th>
                            </thead>

                            <tbody>
                            @forelse($orders as $item)
                                <tr>
                                    <td> {{$item->id}}</td>
                                    <td> {{$item->tracking_no}}</td>
                                    <td> {{$item->fullname}}</td>
                                    <td> {{$item->payment_method}}</td>
                                    <td> {{$item->created_at->format('Y-m-d H:i:s')}}</td>
                                    <td> {{$item->status}}</td>
                                    <td> <a href="{{url('admin/orders/'.$item->id)}}" class="btn btn-primary btn-sm">Хянах </a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No Orders available</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    </div>

@endsection
