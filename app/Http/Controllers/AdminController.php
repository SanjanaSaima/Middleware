<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'orderItems.product')->get();

        return view('admin.index', compact('orders'));
    }
}
