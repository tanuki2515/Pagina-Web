<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'users' => User::where('role', 'cliente')->count(),
            'active_products' => Product::where('active', true)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
