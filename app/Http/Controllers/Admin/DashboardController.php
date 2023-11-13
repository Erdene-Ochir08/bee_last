<?php

namespace App\Http\Controllers\Admin;

use App\Charts\UserChart;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalBrands = Brand::count();

        $totalAllUsers = User::count();
        $totalUser = User::where('role_as','0')->count();
        $totalAdmin =User::where('role_as','1')->count();

        $todayDate = Carbon::now()->format('d-m-Y');
        $thisMonth = Carbon::now()->format('m');

        $totalOrder = Order::count();
        $todayOrder = Order::whereDate('created_at',$todayDate)->count();
        $thisMonthOrder = Order::whereMonth('created_at',$thisMonth)->count();
        $pendingOrders = Order::where('status', '=', 'pending')->count();


        return view('admin.dashboard', compact('totalProducts','totalCategories','totalBrands','totalAllUsers',
                                                              'totalUser','totalAdmin','totalOrder','todayOrder','thisMonthOrder','pendingOrders'
                                                                    ));
    }























}
