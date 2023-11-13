@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <div id="carouselExampleCaptions" class="carousel slide e-slider " data-bs-ride="false">
        <div class="carousel-inner">
            @foreach ($sliders as $key => $sliderItem)
                <div class="carousel-item {{ $key == 0 ? 'active':'' }}">
                    @if ($sliderItem->image)
                        <img src="{{ asset("$sliderItem->image") }}" class="d-block w-100 slider-carousel" alt="Slider">
                    @endif
                    <div class="carousel-caption d-none d-md-block">
                        <div class="custom-carousel-content">
                            <!-- <h1>
                                {!! $sliderItem->title !!}
                            </h1>
                            <p>
                                {!! $sliderItem->description !!}
                            </p>
                            <div>
                                <a href="#" class="btn btn-slider">
                                    Дэлгэрэнгүй
                                </a>
                            </div> -->
                        </div>
                    </div>
                </div>
            @endforeach
                <div class="carousel-item">
                    <img src="https://img.creator-prod.zmags.com/assets/images/65110cf76df9f10f7612e30a.jpeg?im=Resize,width=1536" alt="" width="100%">
                </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="s-banner" style="margin-top:40px;">
        <div class="container">
            <img src="https://img1.theiconic.com.au/zHIB5ly8PtinptF6qHgngfJzoxw=/1280x0/top/filters:quality(70):format(jpeg)/http%3A%2F%2Fstatic.theiconic.com.au%2Fcms%2FRMW_SS24_Iconic_Web_Banner_1.jpeg" alt="" width="100%">
        </div>
    </div>
     <div class="e-all-cat com-cat">
        <div class="container">
            <div class="all-title">
                <h2 class="line-title">Aнгилалууд</h2>
            </div>
            <div class="row" style="margin-bottom:30px;">
            @foreach($genders as $gender)
                <div class="col-md-4">
                    <a href="{{ url('/collections/gender/'.$gender->id) }}">
                    <div class="s-img">
                        <img src="{{ asset("$gender->image") }}" alt="">
                        <h5>{{ $gender->name }}</h5>
                    </div>
                    </a>
                </div>
            @endforeach
            </div>
              <!-- Category -->
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
            <div class="row">
                <div class="col-md-12">
                    <div class="m-btn">
                        <a class="btn btn-lg" href="{{ url('/collections') }}">
                            <span>Цааш үзэх</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <section class="new-product" id="shine">
        <div class="container">
            <div class="row">
                <div class="all-title">
                    <h2 class="line-title">Бүтээгдэхүүнүүд </h2>
                </div>
                <!-- <div class="col-md-3">
                    <div class="n-special">
                        <img src="{{asset($banner->image)}}"
                             alt="">
                    </div>
                </div> -->
                @if($latestProducts)
                    <div class="col-md-12">
                        <div class="row">
                            @foreach ($latestProducts as $productItem)
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
            <div class="row">
                <div class="col-md-12">
                    <div class="m-btn">
                        <a class="btn btn-lg" href="{{ url('/new') }}">
                            <span>Цааш үзэх</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sale-product" id="hymd">
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
            <div class="row">
                <div class="col-md-12">
                    <div class="m-btn">
                        <a class="btn btn-lg" href="{{ url('/sale') }}">
                            <span>Цааш үзэх</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- <section class="new-product" style="padding-top:40px;" id='ontsloh'>
        <div class="container">
            <div class="row">
                <div class="all-title">
                    <h2 class="line-title">Онцлох бүтээгдэхүүнүүд </h2>
                </div>
                @if($trendingProducts)
                    <div class="col-md-9">
                        <div class="row">
                            @foreach ($trendingProducts as $productItem)
                                <div class="col-md-3">
                                    <div class="n-card">
                                        <div class="img">
                                            @if ($productItem->productImages->count() > 0)
                                                <a
                                                    href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                    <img src="{{ asset($productItem->productImages[0]->image) }}"
                                                         alt="{{ $productItem->name }}">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="info">
                                            <h6>
                                                <a
                                                    href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                    {{ $productItem->name }}
                                                </a>
                                            </h6>
                                            <p>
                                                {{ $productItem->brand }}
                                            </p>
                                            <p class="price">
                                                {{ $productItem->price }} ₮
                                            </p>
                                        </div>
                                        <div class="more">
                                        </div>
                                        <p class="sale">{{ $productItem->sale_percent }}%</p>
                                        <p class="add"><i class="bi bi-cart2"></i></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="n-special">
                            <img
                                src="https://api.hitech.mn/uploads/images/2023/7/28/Quadcast-1690553991326888276-full.jpg"
                                alt="">
                            <div class="info">

                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-9">
                        <div class="p-2">
                            <h4>Бүтээгдэхүүн байхгүй байна</h4>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="m-btn">
                        <a class="btn btn-lg" href="{{ url('/trend') }}">
                            <span>Цааш үзэх</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section class="sponser" style="margin-top:40px;">
        <div class="container">
            <div class="all-title">
                <h2 class="line-title">Брэндүүд</h2>
            </div>
            <div class="row">
                @foreach($brands as $brand)
                <div class="col-md-2">
                    <div class="brand">
                        <img src="{{ asset("$brand->image") }}" alt="" width="100%">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $('.trending-product').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })

    </script>
    <script>
    var swiper = new Swiper(".mySwiper2", {
      slidesPerView: 2,
      spaceBetween: 13,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      loop:true,
    });
  </script>

@endsection
