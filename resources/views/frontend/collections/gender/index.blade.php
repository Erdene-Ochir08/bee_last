@extends('layouts.app')

@section('title', 'Шинэ бүтээгдэхүүнүүд ')
@section('content')
    <section class="new-product" id="shine" style="margin-top:40px;">
        <div class="container">
            <div class="row">
                <div class="all-title">
                    <h2 class="line-title">Бүтээгдэхүүнүүд</h2>
                </div>
                @if($genderProducts)
                    <div class="col-md-12">
                        <div class="row">
                            @foreach ($genderProducts as $productItem)
                                <div class="col-md-3">
                                    <div class="b-card">
                                        @if ($productItem->productImages->count() > 0)
                                            <div class="image">
                                                <a
                                                    href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                    <img src="{{ asset($productItem->productImages[0]->image) }}"
                                                         alt="{{ $productItem->name }}" width="100%">
                                                </a>
                                            </div>
                                        @endif
                                        <div class="n-info">
                                            <p>
                                                {{ $productItem->brand }}
                                            </p>
                                            <h6>
                                                <a
                                                    href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                    {{ $productItem->name }}
                                                </a>
                                            </h6>
                                            <p class="price">
                                                {{ $productItem->price }} ₮
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @else
                            <div class="col-md-9">
                                <div class="p-2">
                                    <h4>Бүтээгдэхүүн байхгүй байна</h4>
                                </div>
                            </div>
                        @endif
                    </div>
            </div>
        </div>
    </section>

@endsection
