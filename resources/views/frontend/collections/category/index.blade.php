@extends('layouts.app')

@section('title', 'All Categories')

@section('content')
     <div class="e-all-cat com-cat">
        <div class="container">
            <div class="all-title">
                <h2 class="line-title">Бүх катогерууд</h2>
            </div>
              <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach($categories as $category)
                    <div class="swiper-slide">
                            <a href="{{ url('/collections/'. $category->slug) }}">
                                <div class="s-img">
                                    <img src="{{ asset("$category->image") }}" alt="">
                                    <h5>{{ $category->name }}</h5>
                                </div>
                            </a>
                    </div>
                    @endforeach
                </div>
               <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <div class="e-all-cat mobile-cat">
        <div class="container">
            <div class="all-title">
                <h2 class="line-title">Бүх катогерууд</h2>
            </div>
              <!-- Swiper -->
            <div class="swiper mySwiper2">
                <div class="swiper-wrapper">
                    @foreach($categories as $category)
                    <div class="swiper-slide">
                            <a href="{{ url('/collections/'. $category->slug) }}">
                                <div class="s-img">
                                    <img src="{{ asset("$category->image") }}" alt="">
                                    <h5>{{ $category->name }}</h5>
                                </div>
                            </a>
                    </div>
                    @endforeach
                </div>
               <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

@endsection
