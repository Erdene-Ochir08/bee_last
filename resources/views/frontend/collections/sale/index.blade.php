@extends('layouts.app')

@section('title', 'Хямдралтай бүтээгдэхүүнүүд ')

@section('content')
<section class="sale-product" id="hymd" >
        <div class="container">
            <div class="all-title" style="margin-bottom:90px;">
                <h2 class="line-title">Хямдралтай бүтээгдэхүүнүүд </h2>
                <img src="{{ asset('uploads/sale.png') }}" alt="">
            </div>
            <div class="row">
                @foreach ($saleProducts as $productItem)
                    @if($saleProducts)
                <div class="col-md-2">
                    <div class="sale-card">
                        @if ($productItem->productImages->count() > 0)
                            <a href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                <img src="{{ asset($productItem->productImages[0]->image) }}"
                                                 alt="{{ $productItem->name }}" width="100%">
                            </a>
                        @endif
                        <div class="sale-info">
                            <h6>
                                <a
                                href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                    {{ $productItem->name }}
                                </a>
                            </h6>
                        </div>
                        <p class="sale">{{ $productItem->sale_percent }}% OFF*</p>
                    </div>
                </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>Бүтээгдэхүүн байхгүй байна</h4>
                        </div>
                    </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>

@endsection
