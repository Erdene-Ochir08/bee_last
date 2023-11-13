@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-4"> Миний захиалгууд</h4>
                        <hr>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th>Захиалгийн дугаар</th>
                                    <th>Хэрэглэгчийн нэр</th>
                                    <th>Захиалсан өдөр</th>
                                    <th>Захиалгийн төлөв</th>
                                    <th>Үйлдэл</th>
                                </thead>

                                <tbody>
                                @forelse($orders as $item)
                                    <tr>
                                        <td> {{$item->id}}</td>
                                        <td> {{$item->fullname}}</td>
                                        <td> {{$item->created_at->format('Y-m-d')}}</td>
                                        <td> {{$item->status}}</td>
                                        <td> <a href="{{url('orders/'.$item->id)}}" class="btn btn-primary btn-sm">Дэлгэрэнгүй </a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Orders available</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{$orders->links()}}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
