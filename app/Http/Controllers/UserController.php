<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Information User in Client
    //show profile in My Profile
    public function showProfile()
    {
        Session::put('infor', 'profile');
        return view('information.profile');
    }

    // show form edit basic information
    public function formUpdateBasicInfor()
    {
        return view('information.edit-basic-infor');
    }

    // Update basic information
    public function updateProfileBasic(Request $request)
    {
        $name = $request->input('name');
        $gender = $request->input('gender');
        $birthdate = $request->input('birthdate');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');
        $address = $request->input('address');
        $idUser = $request->input('idUser');
        if ($name == "" || strlen($name) < 5) {
            return response()->json(['status' => "Name must be at least 5 characters"]);
        } elseif ($gender == "") {
            return response()->json(['status' => "Please select your gender"]);
        } elseif (!preg_match("/^([0-2][0-9]|(3)[0-1])(\-)(((0)[0-9])|((1)[0-2]))(\-)\d{4}$/", $birthdate)) {
            return response()->json(['status' => "Write a valid birth date"]);
        } else {
            if (User::where('_id', $idUser)->exists()) {
                $myProfile = User::where('_id', $idUser)->first();
                $myProfile['name'] = $name;
                $myProfile['gender'] = $gender;
                $myProfile['birthdate'] = $birthdate;
                $myProfile['city'] = $city;
                $myProfile['state'] = $state;
                $myProfile['country'] = $country;
                $myProfile['address'] = $address;
                $myProfile->save();
                return response()->json(['status' => "Success"]);
            }
        }
    }

    //show form edit contact information
    public function formUpdateContactInfor()
    {
        return view('information.edit-contact-infor');
    }

    //Update contact information
    public function updateProfileContact(Request $request)
    {
        $mobile = $request->input('mobile');
        $idUser = $request->input('idUser');
        if (!preg_match("/^(09|03|07)\d{8}$/", $mobile)) {
            return response()->json(['status' => "Write a valid mobile number"]);
        } else {
            if (User::where('_id', $idUser)->exists()) {
                $myProfile = User::where('_id', $idUser)->first();
                $myProfile['mobile'] = $mobile;
                $myProfile->save();
                return response()->json(['status' => "Success"]);
            }
        }
    }

    //email verify
    public function emailVerification($id)
    {
        $emailverify = DB::collection('users')->get()->where('rand_id', $id);

        foreach ($emailverify as $verify) {
            User::where('_id', $verify['_id'])->update(['is_verify' => '1']);
        }
        return view('/email.verification');
    }
    //End Information User in Client



    

    //Manage Users Registered in ADMIN
    //Show users registered
    public function users()
    {
        Session::put('page', 'users');
        $users = User::where('role_as', '0')->get();
        return view('admin.users', compact('users'));
    }
    public function updateUserStatus(Request $request)
    {
        $status = $request->input('status');
        $idUser = $request->input('idUser');

        if (User::where('_id', $idUser)->exists()) {
            $updateStatus = User::where('_id', $idUser)->first();
            $updateStatus['status'] = $status;
            $updateStatus->save();
        }
        return response()->json(['status' => "Status has been changed!", 'view' => $status]);
    }
}
