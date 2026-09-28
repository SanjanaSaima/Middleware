<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function index($product_id)
    {
        $product = Product::findOrFail($product_id);

        return view('orders.order', compact('product'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'product_id' => 'required|exists:product,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $product = Product::findOrFail($validated['product_id']);

    $totalPrice = $product->price * $validated['quantity'];

    // Create Order
    $order = Order::create([
        'user_id' => auth()->id(),
        'total_price' => $totalPrice,
    ]);

    // Create Order Item
    OrderItem::create([
        'order_id' => $order->id,
        'product_id' => $product->id,
        'price' => $product->price,
        'quantity' => $validated['quantity'],
    ]);

    return redirect()
        ->route('order.details', $order->id);
}

    public function details($order_id)
    {
        $order = Order::with('orderItems.product')
            ->findOrFail($order_id);

        return view('orders.orderdetails', compact('order'));
    }
}