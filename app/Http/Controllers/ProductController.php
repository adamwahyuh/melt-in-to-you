<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\UpdatePriceRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

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

        return redirect()->route('page.dashboard.stocker.index')->with('success', 'Berhasil menambahkan barang');
    }

    public function updateHarga(Product $product, UpdatePriceRequest $request){
        $data = $request->validated();

        $product->prices()->create(['harga_dalam_rupiah' => $data['harga']]);

        return back()->with('success', 'Berhasil update harga');
    }

    public function updateProduct(Product $product, UpdateRequest $request){
        $data = $request->validated();

        $fotoPath = $product->foto;

        if($request->hasFile('foto')){
            if($product->foto && Storage::disk('public')->exists($product->foto)){
                Storage::disk('public')->delete($product->foto);
            }

            $fotoPath = $request->file('foto')->store('product', 'public');
        }

        $product->update([
            'name'      => $data['name'],
            'deskripsi' => $data['deskripsi'],
            'foto'      => $fotoPath, 
            'is_default'=> false,
        ]);

        return back()->with('success', 'Berhasil update product' );
    }
}
