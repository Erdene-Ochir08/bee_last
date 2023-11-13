<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $guarded = [];

    public function items()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id')->withPivot('quantity', 'price');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id')->withPivot('quantity', 'price');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function totalAmount()
    {
        return $this->items->sum(function ($item) {
            $product = Product::find($item->pivot->product_id);
            if ($product) {
                $subtotal = $item->pivot->price * $item->pivot->quantity;
                $discount = $subtotal * ($product->sale_percent / 100);
                return $subtotal - $discount;
            }
            return 0;
        });
    }
}
