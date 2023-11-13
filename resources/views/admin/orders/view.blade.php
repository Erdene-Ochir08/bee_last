@extends('layouts.admin')
@section('title', 'Order Details')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(session('message'))
                <div class="alert alert-success mb-3">{{ session('message') }}</div>
            @endif

                <div class="card">
                    <div class="card-body">
                        <h4>Захиалгийн төлөв (Энд төлөв өөрчилнө)</h4>

                    <hr>
                    <div class="row ">
                        <div class="col-md-5 ">
                            <form action="{{url('admin/orders/'.$order->id)}}" method="POST">
                                @csrf
                                @method('PUT')

                                <label> Төлөв сонгох</label>

                                <div class="input-group">
                                    <select name="order_status" class="form-select">
                                        <option value="">Select All Status</option>
                                        <option value="confirmed" {{Request::get('status') == 'confirmed' ? 'selected': '' }}>Confirmed</option>
                                        <option value="pending" {{Request::get('status') == 'pending' ? 'selected': ''}}>Pending </option>
                                        <option value="declined" {{Request::get('status') == 'declined' ? 'selected': ''}}>Declined</option>
                                        <option value="delivered" {{Request::get('status') == 'delivered' ? 'selected': ''}}>Delivered</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary text-white">UPDATE</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-7 ">
                            <br>
                            <h4 class="mt-3">ТӨЛӨВ: <span class="text-uppercase">{{$order->status}}</span></h4>
                        </div>
                    </div>
                    </div>
                </div>

            <div class="card">
                <div class="card-header">
                    <h3>My Order Details</h3>
                </div>
                <div class="card-body">

                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            <i class="fa fa-shopping-cart text-dark"> </i> Order Details
                            <a href="{{ url('admin/orders') }}" class="btn btn-danger btn-sm float-end"> Back </a>
                        </h4>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h5> Захиалгийн дэлгэрэнгүй</h5>
                                <hr>
                                <h6>Захиалгийн дугаар: {{$order->id}} </h6>
                                <h6>Unique Number: {{$order->tracking_no}} </h6>
                                <h6>Захиалгийн дугаар:{{$order->created_at->format('d-m-Y: i A')}} </h6>
                                <h6>Төлбөрийн хэлбэр: {{$order->payment_method}}</h6>
                                <h6 class="border p-2 text-success">
                                    Захиалгийн төлөв: <span class="text-uppercase">{{$order->status}}</span>
                                </h6>
                            </div>

                            <div class="col-md-6">
                                <h5> Хэрэглэгчийн дэлгэрэнгүй</h5>
                                <hr>
                                <h6>Хэрэглэгчийн нэр: {{$order->fullname}}</h6>
                                <h6>Email: {{$order->email}} </h6>
                                <h6>дугаар: {{$order->phone}} </h6>
                                <h6>Хаяг: {{$order->address}} </h6>
                            </div>
                        </div>
                        <br>

                        <h5>Захиалсан бараанууд</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Барааны дугаар</th>
                                    <th>Image</th>
                                    <th>Product Gender</th>
                                    <th>Барааны нэр</th>
                                    <th>Хэмжээ</th>
                                    <th>Үнэ</th>
                                    <th>Хямдрал</th>
                                    <th>Тоо хэмжээ</th>
                                    <th>Нийт дүн</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($order->orderItems as $orderItem)
                                    <tr>
                                        <td width="10%"> {{$orderItem->id}}</td>
                                        <td width="10%">
                                            @if($orderItem->product->productImages)
                                                <img src="{{asset($orderItem->product->productImages[0]->image)}}" style="width: 50px; height: 50px" alt="no image">
                                            @else
                                                <img src="" style="width: 50px; height: 50px" alt="">
                                            @endif
                                        </td>

                                        <td>
                                            {{$orderItem->product->gender->name}}
                                        </td>

                                        <td>
                                            {{$orderItem->product->name}}

                                            @if ($orderItem->productColor)
                                                @if ($orderItem->productColor->color)
                                                    <span>- Color :
                                                            {{ $orderItem->productColor->color->name }}</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            {{$orderItem->productSize->size->name}}
                                        </td>
                                        <td width="10%">{{$orderItem->price}} төг</td>
                                        <td width="10%">{{$orderItem->sale_percent}} %</td>
                                        <td width="10%"> {{$orderItem->quantity}} ширхэг</td>
                                        <td width="10%"> {{($orderItem->quantity * $orderItem->price)*(1-$orderItem->sale_percent/100)}} төг</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>




        </div>

    </div>
@endsection






























































