<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Characteristic;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'productCount' => Product::count(),
            'categoryCount' => Category::count(),
            'characteristicCount' => Characteristic::count(),
            'userCount' => User::count(),
            'orderCount' => Order::count(),
        ];

        return view('modules.home.index', $data);
    }
}
