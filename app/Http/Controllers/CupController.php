<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cup\StoreRequest;
use App\Models\Cup;
use App\Models\CupDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CupController extends Controller
{
    public function storeToCup(StoreRequest $request){
        $userLoggedId = Auth::id();

        $user = User::where('id', $userLoggedId)->first();

        $cup = Cup::firstOrCreate(['user_id' => $user->id]);

        $data = $request->validated();

        $detail = $cup->details()->where('product_id', $data['product_id'])->first();

        if($detail) {
            $detail->increment('quantity', $data['quantity']);
        } else{
            $detail = $cup->details()->create([
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
            ]);
        }

        return back()->with('success', 'Ice cream behasil dimasukan ke dalam cup');
    }

    public function subtractOneFromCup(CupDetail $detail){
        if ($detail->quantity > 1){
            $detail->decrement('quantity');
        } else {
            $detail->delete();
        }
        return back()->with('success', 'Ice Cream berhasil dikurangkan');
    }

    public function deleteCupDetail(CupDetail $detail){
        $detail->delete();

        return back()->with('success', 'Ice Cream dihapus dari ');
    }

}
