<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        $prod_check = Product::where('_id', $product_id)->first();

        if (Auth::check()) {
            if ($prod_check) {
                if (Cart::where('idProd', $product_id)->where('idUser', Auth::id())->exists()) 
                {
                    return response()->json(['status' => $prod_check['tenDT'] . " Already Added to cart"]);
                } 
                else 
                {
                    $cartItem = new Cart();
                    $cartItem['idProd'] = $product_id;
                    $cartItem['idUser'] = Auth::id();
                    $cartItem['qtyProd'] = $product_qty;
                    $cartItem->save();
                    return response()->json(['status' => $prod_check['tenDT'] . " Added to cart"]);
                }
            }
        } else {
            return response()->json(['status' => "Login to Continue"]);
        }
    }
}
