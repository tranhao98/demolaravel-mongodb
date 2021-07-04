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

        $this->validation($request, [
            'fullName' => 'required|min:5|max:35',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'city' => 'required|min:5|max:25',
            'state' => 'required|min:5|max:25',
            'country' => 'required',
            'fullAdd' => 'required',
        ]);

        $fullname = $request->input('fullname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');
        $fullAdd = $request->input('fullAdd');
            $infoUser = new infouser();
            $infoUser['idUser'] = Auth::id();
            $infoUser['fullname'] = $fullname;
            $infoUser['email'] = $email;
            $infoUser['phone'] = $phone;
            $infoUser['city'] = $city;
            $infoUser['state'] = $state;
            $infoUser['country'] = $country;
            $infoUser['fullAdd'] = $fullAdd;
            $infoUser->save();

            Cart::where('idUser', Auth::id())->truncate();

            return response()->json(['status' => "Thank you"]);
    }
    public function validateform(){

    }
}
