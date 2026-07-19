<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function loginPage(){
        return view('login');
    }

    public function index(){
        $products = Product::with('prices')->get();
        return view('welcome', compact('products'));
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
        return view();
    }
}
