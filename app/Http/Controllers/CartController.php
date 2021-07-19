<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


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
                    $cartNumber = Cart::where('idUser',Auth::id())->count();
                    $cartMenu = Cart::where('idUser', Auth::id())->get();
                    return response()->json(['status' => $prod_check['tenDT'] . " - Already added to cart",'number' => (string)View::make('includes.mini-cart')->with(compact('cartNumber','cartMenu'))]);
                } else {
                    $cartItem = new Cart();
                    $cartItem['idProd'] = $product_id;
                    $cartItem['idUser'] = Auth::id();
                    $cartItem['qtyProd'] = $product_qty;
                    $cartItem->save();
                    $cartNumber = Cart::where('idUser',Auth::id())->count();
                    $cartMenu = Cart::where('idUser', Auth::id())->get();
                    return response()->json(['status' => $prod_check['tenDT'] . " - Added to cart",'number' => (string)View::make('includes.mini-cart')->with(compact('cartNumber','cartMenu'))]);
                }
            }
        } else {
            return response()->json(['status' => "plsLogin"]);
        }
    }
    public function viewcart()
    {
        $cartItems = Cart::where('idUser', Auth::id())->get();

        return view('cart', compact('cartItems'));
    }
    public function updateProduct(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $quantity = $request->input('quantity');
        if ($quantity <= 0 || $quantity == "") {
            return response()->json(['status' => "Quantity is required"]);
        } else {
            Cart::where('idProd', $prod_id)->update(['qtyProd' => $quantity]);
            $cartItems = Cart::where('idUser', Auth::id())->get();
            return response()->json(['view' => (string)View::make('includes.products-cart-items')->with(compact('cartItems'))]);
        }
    }
    public function deleteProduct(Request $request)
    {
        $prod_id = $request->input('prod_id');
        if (Cart::where('idProd', $prod_id)->where('idUser', Auth::id())->exists()) {
            $cartItem = Cart::where('idProd', $prod_id)->where('idUser', Auth::id())->first();
            $cartItem->delete();
            $cartItems = Cart::where('idUser', Auth::id())->get();
            return response()->json(['status' => "Product Deleted Successfully",'view' => (string)View::make('includes.products-cart-items')->with(compact('cartItems'))]);
        }
    }
}
