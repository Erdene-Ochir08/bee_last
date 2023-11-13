<div class="py-3 py-md-5 single-product" style="background-color: rgb(248, 248, 248);">
    <div class="container">
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="s-card">
                    <div class="row">
                        <div class="col-md-6 " wire:ignore>
                            @if ($product->productImages)
                        <div class="exzoom" id="exzoom">
                            <!-- Images -->
                            <div class="exzoom_img_box">
                                <ul class='exzoom_img_ul'>
                                    @foreach($product->productImages as $itemImg)
                                        <li> <img src="{{ asset($itemImg->image) }}"> </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="exzoom_nav"></div>
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn"> <i class="bi bi-chevron-left"></i> </a>
                                <a href="javascript:void(0);" class="exzoom_next_btn"> <i class="bi bi-chevron-right"></i> </a>
                            </p>
                        </div>
                        @else
                            Зураггүй байна
                        @endif
                        </div>
                        <div class="col-md-6">
                            <div class="info">
                                <p class="route">Home / {{ $product->category->name }} / {{ $product->name }}</p>
                                <h3>{{ $product->name }}</h3>
                                <p class="desc">
                                    {!! $product->small_description !!}
                                </p>
                                <p class="price route">{{ $product->price }}₮</p>
                            <div>
                        </div>
                                <div class="row" style="min-height:150px;">
                                    <div class="col-md-6">
                                        <div class="colors">
                                    <p>Өнгөний сонголт:</p>
                                    @if ($product->productColors->count() > 0)
                                        @if ($product->productColors)
                                            @foreach ($product->productColors as $colorItem)
                                    <span class="item colorSelectionLabel {{ $selectedColorId == $colorItem->id ? 'selectedItem' : '' }}" style="background-color:{{ $colorItem->color->name }};" wire:click="colorSelected({{ $colorItem->id }})">
                                        <i class="bi bi-check2-circle"></i>
                                    </span>
                                            @endforeach
                                        @endif
                                    @endif
                                </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="size">Select Size:</label>
                                            <select wire:model="sizeId" class="form-control">
                                                <option value="">Select Size</option>
                                                @foreach ($product->sizes as $size)
                                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="s-chart">
                                        <a href="">Хэмжээний харьцаа үзэх</a>
                                    </div>
                                </div>
                                <div class="col-md-4 product-view">
                                    <div class="input-group">
                                        <span class="btn btn1" wire:click="quantityDecrement"><i class="fa fa-minus"></i></span>
                                        <input type="text" wire:model="quantityCount" value="{{ $this->quantityCount }}" readonly class="input-quantity" />
                                        <span class="btn btn1" wire:click="quantityIncrement"><i class="fa fa-plus"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-6 product-view">
                                    <button type="button" wire:click="addToCart({{ $product->id }})" class="btn btn1">
                                        <i class="fa fa-shopping-cart"></i> Сагсанд хийх
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="card">
                                <div class="card-header bg-white">
                                    <h4>Бүтээгдэхүүний мэдээлэл</h4>
                                </div>
                                <div class="card-body">

                                    {!! $product->description !!}

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="latest">
                    <h5>Сүүлд нэмэгдсэн</h5>

                    @foreach($latestProduct as $productItem)


                    <div class="row">
                        <div class="col-md-4">

                            @if ($productItem->productImages->count() > 0)
                                <a
                                    href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                    <img src="{{ asset($productItem->productImages[0]->image) }}"
                                         alt="{{ $productItem->name }}" width="100%">
                                </a>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="info">
                                <h6>{{$productItem->name}}</h6>
                                <p class="price">{{ $productItem->price }} ₮</p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function(){
            $("#exzoom").exzoom({
                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,
                "autoPlay": false,
                "autoPlayTimeout": 2000
            });
        });
    </script>

    <script>
        // Get all tables and add the class "table table-bordered"
        var tables = document.querySelectorAll('table');
        for (var i = 0; i < tables.length; i++) {
            tables[i].classList.add('table', 'table-bordered');
        }
    </script>
@endpush


