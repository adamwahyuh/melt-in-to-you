<?php

namespace App\Http\Controllers;

use App\Models\Address;
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
        $orders = Order::with(['details.product', 'user'])->orderBy('created_at', 'DESC')->get();
        $todayOrders = Order::with(['details.product', 'user'])->today()->get();
        $todayEarnings = Order::today()->whereNotNull('diproses_pada')->whereNotNull('dikirim_pada')
                                ->get()->sum('total_harga');
        
        $todayCustomers = Order::today()->distinct('user_id')->count();

        return view('dashboard.kasir.index', compact('orders', 'todayOrders', 'todayEarnings', 'todayCustomers'));
    }
    public function stockerIndexPage(){
        $products = Product::with('prices')->get();
        // dd($products);

        return view('dashboard.stocker.index', compact('products'));
    }
    public function ownerIndexPage(Request $request){
        $filter = $request->input('filter', 'semua');

        $ordersDone = Order::selesai()
            ->when($filter === 'harian', function ($query) {
                $query->whereDate('dipesan_pada', today());
            })
            ->when($filter === 'mingguan', function ($query) {
                $query->whereBetween('dipesan_pada', [
                    now()->startOfWeek(),
                    now()->endOfWeek(),
                ]);
            })
            ->when($filter === 'bulanan', function ($query) {
                $query->whereMonth('dipesan_pada', now()->month)
                    ->whereYear('dipesan_pada', now()->year);
            })
            ->get();

            $totalHargaPenjualan = $ordersDone->sum('totalHarga');
            $totalProdukTerjual = $ordersDone->count();
            $totalPembeliUnik = $ordersDone->pluck('user_id')->unique()->count();

            
        return view('dashboard.owner.index', compact('filter', 'ordersDone', 'totalHargaPenjualan', 'totalProdukTerjual', 'totalPembeliUnik'));
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
        $cupDetails = $user->cup->details ?? [];
        return view('cup.index', compact('cupDetails', 'cup'));
    }

    public function orderPage(){
        $userLoggedId = Auth::id();
        $user = User::with('orders.details.product')->where('id', $userLoggedId)->first();
        $orders = $user->orders ?? [];
        return view('order.index', compact('orders'));
    }

    public function orderDetailPage(Order $order){
        $order->load('details.product');
        return view('order.show', compact('order'));
    }

    public function pageCreateAddress(User $user){
        if($user->addresses) return redirect()->route('page.home');
        if(Auth::user()->username !== $user->username) return redirect()->route('page.address.create', Auth::user()->username);
        return view('create-alamat', compact('user'));
    }

    public function pageEditAddress(Address $address){
        return view('edit-alamat', compact('address'));
    }
}
