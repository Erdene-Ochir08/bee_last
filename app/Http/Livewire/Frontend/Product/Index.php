<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\Gender;
use Livewire\Component;

class Index extends Component
{
    public $products, $category, $brandInputs = [], $priceInput, $colorInputs = [], $sizeInputs = [];
    public $selectedGender;

    protected $queryString = [
        'brandInputs' => ['except' => '', 'as' => 'brand'],
        'priceInput' => ['except' => '', 'as' => 'price'],
        'colorInputs' => ['except' => '', 'as' => 'color'],
        'sizeInputs' => ['except' => '', 'as' => 'size'],
        'selectedGender',
    ];

    public function mount($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $query = Product::where('category_id', $this->category->id)
            ->when($this->brandInputs, function ($q) {
                $q->whereIn('brand', $this->brandInputs);
            })
            ->when($this->colorInputs, function ($q) {
                $q->whereHas('productColors', function ($q2) {
                    $q2->whereIn('color_id', $this->colorInputs);
                });
            })
            ->when($this->sizeInputs, function ($q) {
                $q->whereHas('productSizes', function ($q2) {
                    $q2->whereIn('size_id', $this->sizeInputs);
                });
            })
            ->when($this->priceInput, function ($q) {
                $q->when($this->priceInput == 'high-to-low', function ($q2) {
                    $q2->orderBy('price', 'DESC');
                })->when($this->priceInput == 'low-to-high', function ($q2) {
                    $q2->orderBy('price', 'ASC');
                });
            })
            ->where('status', '0')
            ->where('quantity', '>', 0);

        if ($this->selectedGender) {
            // Add a gender filter
            $query->where('gender_id', $this->selectedGender);
        }

        $this->products = $query->get();

        $colors = Color::all();
        $sizes = Size::all();
        $genders = Gender::all();

        return view('livewire.frontend.product.index', [
            'products' => $this->products,
            'category' => $this->category,
            'colors' => $colors,
            'sizes' => $sizes,
            'genders' => $genders,
        ]);
    }
}