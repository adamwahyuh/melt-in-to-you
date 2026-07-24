<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    //
    public function loginPage(){
        return view('login');
    }

    public function index(){
        $products = Product::with('prices')->get();
        return view('menu', compact('products'));
    }
    public function registerPage(){
        return view('register');
    }

    public function dashboardPage(){
        return view('dashboard.index');
    }

    public function kasirIndexPage(){
        return view('dashboard.kasir.index');
    }
    public function stockerIndexPage(){
        $products = Product::with('prices')->get();
        // dd($products);

        return view('dashboard.stocker.index', compact('products'));
    }
    public function ownerIndexPage(){
        return view('dashboard.owner.index');
    }

    public function editProductPage(Product $product){
        $product->load('prices');

        return view('dashboard.stocker.edit', compact('product'));
    }

    public function createProductPage(){
        return view('dashboard.stocker.create');
    }

    public function cupPage(){
        $userLoggedId = Auth::id();
        $user = User::with('cup.details')->where('id', $userLoggedId)->first();

        $cup = $user->cup;
        $cupDetails = $user->cup->details;
        return view('cup.index', compact('cupDetails', 'cup'));
    }

    public function orderPage(){
        $userLoggedId = Auth::id();
        $user = User::with('orders.details.product')->where('id', $userLoggedId)->first();
        $orders = $user->orders;
        return view('order.index', compact('orders'));
    }

    public function orderDetailPage(Order $order){
        return view('order.show');
    }
}
