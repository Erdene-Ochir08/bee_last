<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Mail\OrderSentAdmin;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Str;

class CheckoutShow extends Component
{
    public $carts, $totalAmount = 0;

    public $fullname, $email, $phone, $address, $payment_method = NULL, $payment_id = NULL, $uniqueNumber, $client;

    public function rules()
    {
        return [
            'fullname' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|max:8|min:8',
            'address' => 'required|string|max:500'
        ];
    }

    public function placeOrder()
    {
        $this->validate();
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => $this->uniqueNumber,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'payment_method' => $this->payment_method,
        ]);

        foreach ($this->carts as $cartItem) {

            $orderItems = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'product_size_id' => $cartItem->product_size_id,
                'quantity' => $cartItem->quantity,
                'sale_percent' => $cartItem->product->sale_percent,
                'price' => $cartItem->product->price
            ]);

        }
        return $order;
    }

    public function codOrder()
    {
        $this->payment_method = 'transfer';
        $codOrder = $this->placeOrder();

        if ($codOrder) {
//            Mail::to('chinkhuu14@gmail.com')->send(new OrderSentAdmin($codOrder));

            Cart::where('user_id', auth()->user()->id)->delete();

            session()->flash('message', 'Order Placed Successfully');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Захиалга амжилттай хийгдлээ',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect()->to('thank-you');
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }

    public function codOrderBank()
    {
        $this->payment_method = 'bank';
        $codOrder = $this->placeOrder();

        if ($codOrder) {

            Cart::where('user_id', auth()->user()->id)->delete();

            session()->flash('message', 'Захиалга амжилттай хийгдлээ');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Захиалга амжилттай хийгдлээ',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect()->to('thank-you');
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }

    public function totalAmount()
    {
        $this->totalAmount = 0;
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();

        foreach ($this->carts as $cartItem) {
            $this->totalAmount += ($cartItem->product->price * $cartItem->quantity) - ($cartItem->product->price * $cartItem->quantity *($cartItem->product->sale_percent/100));
        }
        return  $this->totalAmount;
    }

    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->totalAmount = $this->totalAmount();
        $this->uniqueNumber = str_pad(rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
        $this->client = Client::findOrFail('d03a7f43-f1e3-47b0-8a61-21e79df08c7f');
        return view('livewire.frontend.checkout.checkout-show', [
            'totalAmount' => $this->totalAmount,
            'uniqueNumber' => $this->uniqueNumber,
            'client' => $this->client,
        ]);
    }
}
