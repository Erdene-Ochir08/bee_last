@extends('layouts.app')

@section('title', 'Хямдралтай бүтээгдэхүүнүүд ')

@section('content')
<section class="sale-product" id="hymd" >
        <div class="container">
            <div class="all-title" style="margin-bottom:90px;">
                <h2 class="line-title">Хэмжээст үзүүлэлтүүд</h2>
            </div>
            <div class="row">
                @foreach ($charts as $chart)
                <div class="col-md-4">
                    <div class="sale-card">
                            <img src="{{ asset("$chart->image") }}" alt="" width="100%">
                            <h5>{{ $chart->title }}</h5>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
