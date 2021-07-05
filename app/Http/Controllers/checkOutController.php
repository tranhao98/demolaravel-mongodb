<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\infoUser;

class checkOutController extends Controller
{
    public function index()
    {
        $nsx = DB::collection('nhasanxuat');
        $nsx = $nsx->get();
        $cartItems = Cart::where('idUser', Auth::id())->get();
        return view('checkout', compact('nsx', 'cartItems'));
    }

    public function placeOrder(Request $request)
    {

        $fullname = $request->input('fullName');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');
        $fullAdd = $request->input('fullAdd');
        $grandTotal = $request->input('grandTotal');
        $idProd = $request->input('idProd');
        if ($fullname == "" || strlen($fullname) < 5) {
            return response()->json(['status' => "Full name is required"]);
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['status' => "Write a valid e-mail address"]);
        } elseif (!preg_match("/^(09|03|07)\d{8}$/", $phone)) {
            return response()->json(['status' => "Write a valid phone number"]);
        } elseif ($city == "") {
            return response()->json(['status' => "City name is required"]);
        } elseif ($state == "") {
            return response()->json(['status' => "State is required"]);
        } elseif ($country == "") {
            return response()->json(['status' => "Country is required"]);
        } elseif ($fullAdd == "") {
            return response()->json(['status' => "Full address is required"]);
        } else {
            $infoUser = new infoUser();
            $infoUser['idUser'] = Auth::id();
            $infoUser['fullname'] = $fullname;
            $infoUser['email'] = $email;
            $infoUser['phone'] = $phone;
            $infoUser['city'] = $city;
            $infoUser['state'] = $state;
            $infoUser['country'] = $country;
            $infoUser['fullAdd'] = $fullAdd;
            $infoUser['grandTotal'] = $grandTotal;
            $infoUser['idProd'] = $idProd;
            $infoUser->save();

            Cart::where('idUser', Auth::id())->delete();

            return response()->json(['status' => "Paid"]);
        }
    }
}
