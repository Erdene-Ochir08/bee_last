<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $category, $product, $quantityCount = 1, $prodColorSelectedQuantity, $productColorId, $sizeId;

    public function quantityDecrement()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }

    public function quantityIncrement()
    {
        if ($this->quantityCount < $this->product->quantity) {
            $this->quantityCount++;
        }
    }
    public $selectedColorId;
    public function colorSelected($productColorId)
    {
        $this->productColorId = $productColorId;
        $productColor = $this->product->productColors()->where('id', $productColorId)->first();
        $this->prodColorSelectedQuantity = $productColor->quantity;

        if ($this->prodColorSelectedQuantity == 0) {
            $this->prodColorSelectedQuantity = 'outOfStock';
        }
        $this->selectedColorId = $productColorId;
    }

    public function addToCart(int $productId)
    {
        if (Auth::check()) {
            if ($this->product->where('id', $productId)->where('status', '0')->exists()) {
                if ($this->product->productColors()->count() > 1) {
                    if ($this->prodColorSelectedQuantity != NULL && $this->sizeId) {
                        if ($this->product->productSizes()->where('size_id', $this->sizeId)->exists()) {
                            if (Cart::where('user_id', auth()->user()->id)
                                ->where('product_id', $productId)
                                ->where('product_color_id', $this->productColorId)
                                ->where('product_size_id', $this->sizeId)
                                ->exists()
                            ) {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Product Already Added!',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            } else {
                                $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();
                                if ($productColor->quantity > 0) {
                                    if ($productColor->quantity > $this->quantityCount) {
                                        Cart::create([
                                            'user_id' => auth()->user()->id,
                                            'product_id' => $productId,
                                            'product_color_id' => $this->productColorId,
                                            'product_size_id' => $this->sizeId,
                                            'quantity' => $this->quantityCount
                                        ]);
                                        $this->emit('cartAddedUpdated');
                                        $this->dispatchBrowserEvent('message', [
                                            'text' => 'Product Added to Cart.',
                                            'type' => 'success',
                                            'status' => 200
                                        ]);
                                    } else {
                                        $this->dispatchBrowserEvent('message', [
                                            'text' => 'Only ' . $productColor->quantity . ' Products Available in Stock!',
                                            'type' => 'warning',
                                            'status' => 404
                                        ]);
                                    }
                                } else {
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Out of Stock!',
                                        'type' => 'warning',
                                        'status' => 404
                                    ]);
                                }
                            }
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Invalid size selected for this product!',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Please select both Product Color and Size!',
                            'type' => 'info',
                            'status' => 401
                        ]);
                    }
                } else {
                    if ($this->sizeId) {
                        if ($this->product->productSizes()->where('size_id', $this->sizeId)->exists()) {
                            if (Cart::where('user_id', auth()->user()->id)
                                ->where('product_id', $productId)
                                ->where('product_size_id', $this->sizeId)
                                ->exists()
                            ) {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Product Already Added!',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            } else {
                                if ($this->product->quantity > 0) {
                                    if ($this->product->quantity > $this->quantityCount) {
                                        Cart::create([
                                            'user_id' => auth()->user()->id,
                                            'product_id' => $productId,
                                            'product_size_id' => $this->sizeId,
                                            'quantity' => $this->quantityCount
                                        ]);
                                        $this->emit('cartAddedUpdated');
                                        $this->dispatchBrowserEvent('message', [
                                            'text' => 'Product Added to Cart.',
                                            'type' => 'success',
                                            'status' => 200
                                        ]);
                                    } else {
                                        $this->dispatchBrowserEvent('message', [
                                            'text' => 'Only ' . $this->product->quantity . ' Products Available in Stock!',
                                            'type' => 'warning',
                                            'status' => 404
                                        ]);
                                    }
                                } else {
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Out of Stock!',
                                        'type' => 'warning',
                                        'status' => 404
                                    ]);
                                }
                            }
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Invalid size selected for this product!',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Please select a Size!',
                            'type' => 'info',
                            'status' => 401
                        ]);
                    }
                }
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product does not exist!',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to add to Cart!',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }

    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function render()
    {
        $latestProducts = Product::latest()->take(5)->get();

        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product,
            'latestProduct' => $latestProducts,
        ]);
    }
}
