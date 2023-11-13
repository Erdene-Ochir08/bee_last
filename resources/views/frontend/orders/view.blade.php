@extends('layouts.app')
@section('title', 'My orders Details')

@section('content')
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            <i class="fa fa-shopping-cart text-dark"> </i> Миний захиалгын дэлгэрэнгүй мэдээлэл
                            <a href="{{ url('orders') }}" class="btn btn-danger btn-sm float-end"> Back </a>
                        </h4>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Захиалгийн дэлгэрэнгүй</h5>
                                <hr>
                                <h6>Захиалгийн дугаар: {{$order->id}} </h6>
                                <h6>Захиалсан өдөр: {{$order->created_at->format('Y-m-d')}} </h6>
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
                                <h6>Утасны дугаар: {{$order->phone}} </h6>
                                <h6>Хүргүүлэх хаяг:{{$order->address}} </h6>
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
                                    <th>Зураг</th>
                                    <th>Product Gender</th>
                                    <th>Барааны нэр</th>
                                    <th>Хэмжээ</th>
                                    <th>Үнэ</th>
                                    <th>Хямдралын хувь</th>
                                    <th>Тоо хэмжээ</th>
                                    <th>Нийт Дүн</th>
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
{{--                            <div>--}}
{{--                                {{$orders->links() }}--}}
{{--                            </div>--}}

                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
