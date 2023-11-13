<div>
    <div class="row">
        <div class="col-md-3">
            @if ($category->brands)
                <div class="card" style="margin-bottom:25px;">
                    <div class="card-header">
                        <h4>Брэндүүд</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($category->brands as $item)
                            <label class="d-block">
                                <input type="checkbox" wire:model="brandInputs" value="{{ $item->name }}">
                                {{ $item->name }}
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif
                <!-- Gender Filters -->
                <div class="card" style="margin-bottom: 25px;">
                    <div class="card-header">
                        <h4>Хүйс сонголт</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($genders as $gender)
                            <label class="d-block">
                                <input type="radio" wire:model="selectedGender" value="{{ $gender->id }}">
                                {{ $gender->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Color Filters -->
                <div class="card" style="margin-bottom: 25px;">
                    <div class="card-header">
                        <h4>Өнгөн сонголт</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($colors as $color)
                            <label class="d-block">
                                <input type="checkbox" wire:model="colorInputs" value="{{ $color->id }}">
                                {{ $color->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Size Filters -->
                <div class="card" style="margin-bottom: 25px;">
                    <div class="card-header">
                        <h4>Хэмжээ сонголт</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($sizes as $size)
                            <label class="d-block">
                                <input type="checkbox" wire:model="sizeInputs" value="{{ $size->id }}">
                                {{ $size->name }}
                            </label>
                        @endforeach
                    </div>
                </div>


            <div class="card" style="margin-bottom:25px;">
                <div class="card-header">
                    <h4>Үнэ</h4>
                </div>
                <div class="card-body">
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="high-to-low"> Үнэ ихээс бага руу
                    </label>
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="low-to-high">
                        Үнэ багаас их рүү
                    </label>
                </div>
            </div>

        </div>

        <div class="col-md-9 new-product">

                        <div class="row">
                            @forelse ($products as $productItem)
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
                            @empty
                            <div class="col-md-12">
                                <div class="p-2">
                                    <h4>Уг "{{ $category->name }}" категорид бүтээгдэхүүн ороогүй байна</h4>
                                </div>
                            </div>
                        @endforelse
                        </div>
        </div>
    </div>
</div>