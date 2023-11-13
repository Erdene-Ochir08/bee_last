<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderSentUser;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $todayDate = Carbon::now()->format('Y-m-d');

        $orders = Order::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at',$request->date);
        }, function ($q) use ($todayDate) {
            return $q->whereDate('created_at',$todayDate);
        })->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function all_orders(Request $request)
    {
        $orders = Order::orderBy('created_at','ASC')->get();

        return view('admin.orders.all_orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        if($order)
        {
            return view('admin.orders.view',compact('order'));
        }
        else
        {
            return redirect('admin/new-orders')-with('message','Order Not Found');
        }
    }

    public function updateOrderStatus($id, Request $request)
    {
        $order = Order::findOrFail($id);

        if (!$order) {
            return redirect('admin/orders/'.$id)->with('message', 'Order Not Found');
        }

        $oldStatus = $order->status;
        $newStatus = $request->order_status;

        // Update the order status
        $order->update([
            'status' => $newStatus,
        ]);

        // Check if the new status is 'confirmed' and the old status is not 'confirmed'
        if ($newStatus === 'confirmed' && $oldStatus !== 'confirmed') {
            // Reduce the quantity of ordered product_colors
            foreach ($order->orderItems as $orderItem) {
                if ($orderItem->productColor) {
                    $productColor = $orderItem->productColor;
                    $newQuantity = $productColor->quantity - $orderItem->quantity;
                    if ($newQuantity < 0) {
                        $newQuantity = 0;
                    }
                    $productColor->update([
                        'quantity' => $newQuantity,
                    ]);

                    $product = $productColor->product;
                    $totalQuantity = $product->productColors->sum('quantity');
                    $product->update(['quantity' => $totalQuantity]);
                }
            }
        }



//        if ($newStatus !== $oldStatus) {
//            Mail::to($order->email)->send(new OrderSentUser($order));
//        }

        return redirect('admin/orders/'.$id)->with('message', 'Order Status Updated');
    }































}
