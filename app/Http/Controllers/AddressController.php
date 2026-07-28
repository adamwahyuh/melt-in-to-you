<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\CreateRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    //
    public function createAddress(User $user, CreateRequest $request){
        $data = $request->validated();

        $address = $user->addresses()->create([
            'rt' => $data['rt'],
            'rw' => $data['rw'],
            'kecamatan' => $data['kecamatan'],
            'kelurahan' => $data['kelurahan'],
            'kota' => $data['kota'],
            'alamat' => $data['alamat'],
            'kode_pos' => $data['kode_pos'],

            'is_active' => true,
        ]);

        return redirect()->route('page.home')->with('success', 'Welcome to ' . config('app.name'));
    }

    public function deleteAddress(User $user,Address $address){
        $addressesCount = $user->addresses->count();

        if($addressesCount <= 1) return back()->with('error', 'Tidak bisa menghapus alamat');

        $address->delete();

        return back()->with('success', 'Berhasil menghapus alamat');
    }

    public function updateAddress(Address $address, CreateRequest $request){
        $data = $request->validated();

        $address = $address->update([
            'rt' => $data['rt'],
            'rw' => $data['rw'],
            'kecamatan' => $data['kecamatan'],
            'kelurahan' => $data['kelurahan'],
            'kota' => $data['kota'],
            'alamat' => $data['alamat'],
            'kode_pos' => $data['kode_pos'],

            'is_active' => true,
        ]);

        return back()->with('success', 'Berhasil mengganti address');
    }

    public function changeActiveAddress(Address $address){
        $activeAddresses = Address::where('is_active', true)->update(['is_active' => false]);

        $address->update(['is_active' => true]);

        return back()->with('success', 'Mengganti alamat aktif');
    }
}
