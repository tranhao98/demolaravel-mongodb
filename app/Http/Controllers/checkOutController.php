<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\infoUser;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Models\Coupons;
use Illuminate\Support\Facades\View;
use App\Models\OrdersProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('idUser', Auth::id())->get();
        return view('checkout', compact('cartItems'));
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
        $couponCode = $request->input('couponCode');
        $couponAmount = $request->input('couponAmount');
        if ($fullname == "" || strlen($fullname) < 5) {
            return response()->json(['status' => "Full name must be at least 5 characters"]);
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

            //Insert Order Details
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
            $infoUser['status'] = '0';
            $infoUser['couponCode'] = $couponCode;
            $infoUser['couponAmount'] = $couponAmount;
            $infoUser->save();

            // Get last insert Order Id
            $getlastidOrder  = infoUser::latest('_id')->first();
            $idOrder = $getlastidOrder->_id;
            $formatNumberOrder = substr($getlastidOrder->_id, 20, 4);
            $formatgrandtotal = number_format($grandTotal, 0, ',', '.');
            //Get User Cart Items
            $cartItems = Cart::where('idUser', Auth::id())->get();
            foreach ($cartItems as $item) {
                $cartItem = new OrdersProduct();
                $cartItem['idOrder'] = $idOrder;
                $cartItem['idUser'] = Auth::id();

                $getProductDetails = Product::select('tenDT', 'giaKM')->where('_id', $item['idProd'])->first();

                $cartItem['idProd'] = $item['idProd'];
                $cartItem['product_name'] = $getProductDetails['tenDT'];
                $cartItem['product_price'] = $getProductDetails['giaKM'];
                $cartItem['product_qty'] = $item['qtyProd'];
                $cartItem->save();
            }
            $getlastidProduct = OrdersProduct::where('idOrder', $idOrder)->get();
            $data = [
                'fullname' => $request->input('fullName'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'country' => $request->input('country'),
                'fulladd' => $request->input('fullAdd'),
                'grandtotal' => number_format($grandTotal, 0, ',', '.'),
                'product' => $getlastidProduct
            ];
            $user['to'] = $request->input('email');
            Mail::send(
                'email/email_place_order',
                $data,
                function ($messages) use ($user) {
                    $messages->to($user['to']);
                    $messages->subject('HPhone Website [Order]');
                }
            );
            $request->session()->forget('couponCode');
            $request->session()->forget('couponAmount');
            $request->session()->forget('grandTotal');
            Cart::where('idUser', Auth::id())->delete();
            return response()->json(['status' => "Paid", 'numberOrder' => $formatNumberOrder, 'grandTotal' => $formatgrandtotal]);
        }
    }

    //Apply Coupon
    public function applyCoupon(Request $request)
    {
        $code = $request->input('code');

        $couponCount = Coupons::where('coupon_code', $code)->count();
        if ($couponCount == 0) {
            $message = "This coupon is not valid!";
            if (isset($message)) {
                return response()->json(['message' => $message]);
            }
        } else {
            $couponDetail = Coupons::where('coupon_code', $code)->first();
            //check if coupon is Inactive
            if ($couponDetail->status == 0) {
                $message = 'This coupon is not active!';
            }
            //check if coupon is expired
            $expiry_date = strtotime($couponDetail->expiry_date);
            $current_date = strtotime(date('d-m-Y'));
            if ($expiry_date < $current_date) {
                $message = 'This coupon is expired';
            }
            //check if coupon is for Single or Multiple times
            if ($couponDetail->coupon_type == 'Single Times') {
                //Check in Orders collection if coupon already availed by the user
                $couponCount = infoUser::where('couponCode', $code)->where('idUser', Auth::id())->count();
                if ($couponCount >= 1) {
                    $message = "This coupon code is already availed by you!";
                }
            }
            //check if coupon is from categories
            $catArr = explode(',', $couponDetail->categories);
            $cartItems = Cart::where('idUser', Auth::id())->get();
            //check if coupon is from users
            if (!empty($couponDetail->users)) {
                $usersArr = explode(',', $couponDetail->users);
                foreach ($usersArr as $user) {
                    $getIdUser = User::select('_id')->where('email', $user)->first();
                    $userID[] = $getIdUser['_id'];
                }
            }

            $total_amount = 0;
            foreach ($cartItems as $item) {
                if (!in_array($item->products['idNSX'], $catArr)) {
                    $message = 'This coupon code is not for one of the selected products!';
                }
                if (!empty($couponDetail->users)) {
                    if (!in_array($item['idUser'], $userID)) {
                        $message = 'This coupon code is not for you!';
                    }
                }
                $total_amount += $item['qtyProd'] * $item->products['giaKM'];
            }
            //message
            if (isset($message)) {
                return response()->json(['message' => $message]);
            } else {
                //check if amount type is Fixed or Percent
                if ($couponDetail->amount_type == "Fixed") {
                    $couponAmount = $couponDetail->amount;
                } else {
                    $couponAmount = ($total_amount * $couponDetail->amount) / 100;
                }
                $taxAmount = ($total_amount * 5) / 100;
                $grandTotal = $total_amount + $taxAmount - $couponAmount;
                //add Coupon Code & Amount in session
                Session::put('couponAmount', $couponAmount);
                Session::put('couponCode', $code);
                Session::put('grandTotal', $grandTotal);


                $status = "1";
                if (isset($status)) {
                    $cartItems = Cart::where('idUser', Auth::id())->get();
                    return response()->json(['status' => $status, 'view' => (string)View::make('includes.cart-checkout')->with(compact('cartItems'))]);
                }
            }
        }
    }
    public function changeCoupon(Request $request)
    {
        $request->session()->forget('couponCode');
        $request->session()->forget('couponAmount');
        $request->session()->forget('grandTotal');
        $cartItems = Cart::where('idUser', Auth::id())->get();
        return response()->json(['status' => "Remove", 'view' => (string)View::make('includes.cart-checkout')->with(compact('cartItems'))]);
    }
}
