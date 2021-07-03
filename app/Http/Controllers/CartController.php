<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
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
                if (Cart::where('idProd', $product_id)->where('idUser', Auth::id())->exists()) {
                    return response()->json(['status' => $prod_check['tenDT'] . " Already added to cart"]);
                } else {
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
    public function viewcart()
    {
        $nsx = DB::collection('nhasanxuat');
        $nsx = $nsx->get();
        $cartItems = Cart::where('idUser', Auth::id())->get();

        return view('cart', compact('cartItems', 'nsx'));
    }
    public function updatecart(Request $request, $key, $qty)
    {
        $cart = $request->session()->get('cart');
        $cart[$key]['qty'] = $qty;
        $request->session()->put('cart', $cart);
    }

    public function deleteProduct(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->input('prod_id');
            if (Cart::where('idProd', $prod_id)->where('idUser', Auth::id())->exists()) {
                $cartItem = Cart::where('idProd', $prod_id)->where('idUser', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' => "Product Deleted Successfully"]);
            }
        } else {
            return response()->json(['status' => "Login to Continue"]);
        }
    }
}
