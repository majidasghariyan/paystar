<?php

namespace App\Repositories\cart;

use App\Models\Cart;
use App\Repositories\cart\CartRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartRepository implements CartRepositoryInterface
{
    public function get_all() 
    {
        return Cart::orderByDesc('id')->paginate(15)->appends(request()->except('page'));
    }

    public function createCart($request)
    {  
        Cart::create([
            'user_id' => Auth::user()->id,
            'bank_id' => $request->bank_id,
            'shomare_cart' => $request->shomare_cart,
            'shomare_shaba' => $request->shomare_shaba,
        ]); 
    }

    public function updateCart($request, $cart)
    {
        $cart->update([
            'user_id' => Auth::user()->id,
            'bank_id' => $request->bank_id,
            'shomare_cart' => $request->shomare_cart,
            'shomare_shaba' => $request->shomare_shaba,
        ]);
        
    }

    public function deleteCart($Cart)
    {
        $Cart->delete();
    }
}