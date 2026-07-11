<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateRequest;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function deleteProduct(Product $product){
        $product->delete();

        return back()->with('success', 'Produk telah dihapus');
    }

    public function store(CreateRequest $request){
        $data = $request->validated();

        $data['foto'] = $request->file('foto')->store('product', 'public');

        $product = Product::create([
            'name' => $data['name'],
            'deskripsi' => $data['deskripsi'],
            'foto' => $data['foto'],
        ]);

        $product->prices()->create([
            'harga_dalam_rupiah' => $data['harga'],
        ]);

        return back()->with('success', 'Berhasil menambahkan barang');
    }
}
