<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $nsx = DB::collection('nhasanxuat');
        $nsx = $nsx->get();
        return view('my-profile', compact('nsx'));
    }
    public function updateProfile(Request $request)
    {
        $name = $request->input('name');
        $mobile = $request->input('mobile');
        $email = $request->input('email');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');
        $address = $request->input('address');
        $idUser = $request->input('idUser');
        if ($name == "" || strlen($name) < 5) {
            return response()->json(['status' => "Name must be at least 5 characters"]);
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['status' => "Write a valid e-mail address"]);
        } elseif (!preg_match("/^(09|03|07)\d{8}$/", $mobile)) {
            return response()->json(['status' => "Write a valid phone number"]);
        } else {
            if (User::where('_id', $idUser)->exists()) {
                $myProfile = User::where('_id', $idUser)->first();
                $myProfile['name'] = $name;
                $myProfile['mobile'] = $mobile;
                $myProfile['email'] = $email;
                $myProfile['city'] = $city;
                $myProfile['state'] = $state;
                $myProfile['country'] = $country;
                $myProfile['address'] = $address;
                $myProfile->save();
                return response()->json(['status' => "Success"]);
            }
        }
    }
}
