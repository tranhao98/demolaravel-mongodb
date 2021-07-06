<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Coupons;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CouponsController extends Controller
{
    public function coupons()
    {
        Session::put('page', 'coupons');
        $coupons = Coupons::get();
        return view('admin.coupons', compact('coupons'));
    }
    public function updateCouponStatus(Request $request)
    {
        $status = $request->input('status');
        $idCoupon = $request->input('idCoupon');

        if (Coupons::where('_id', $idCoupon)->exists()) {
            $updateStatus = Coupons::where('_id', $idCoupon)->first();
            $updateStatus['status'] = $status;
            $updateStatus->save();
        }
        return response()->json(['status' => "Status has been changed!"]);
    }
    public function addEditCoupon(Request $request, $id = null)
    {
        if ($id == '') {
            $coupon = new Coupons;
            $selCats = array();
            $selUsers = array();
            $title = 'Add Coupon';
            $message = 'Coupon added successfully';
        } else {
            $coupon = Coupons::find($id);
            $selCats = explode(',',$coupon['categories']);
            $selUsers = explode(',',$coupon['users']);
            $title = 'Edit Coupon';
            $message = 'Coupon updated successfully';
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
         
            $rules = [
                'categories' => 'required',
                'coupon_option' => 'required',
                'coupon_type' => 'required',
                'amount_type' => 'required',
                'amount' => 'required|numeric',
                'expiry_date' => 'required',
            ];
            $customMessage = [
                'categories.required' => 'Select Categories',
                'coupon_option.required' => 'Select Coupon Option',
                'coupon_type.required' => 'Select Coupon Type',
                'amount_type.required' => 'Select Amount Type',
                'amount.required' => 'Enter Amount',
                'amount.numeric' => 'Enter Valid Amount',
                'expiry_date.required' => 'Enter Expiry Date',
            ];
            $this->validate($request,$rules,$customMessage);

            if (isset($data['users'])) {
                $users = implode(',', $data['users']);
            }
            else{
                $users = "";
            }
            if (isset($data['categories'])) {
                $categories = implode(',', $data['categories']);
            }
            if ($data['coupon_option'] == "Automatic") {
                $coupon_code = Str::random(8);
            } else {
                $coupon_code = $data['coupon_code'];
            }
            //    echo $coupon_code; die;
            $coupon->coupon_option = $data['coupon_option'];
            $coupon->coupon_code = $coupon_code;
            $coupon->users = $users;
            $coupon->categories = $categories;
            $coupon->coupon_type = $data['coupon_type'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->amount = $data['amount'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->status = "1";
            $coupon->save();
            session::flash('success_message', $message);
            return redirect('admin/coupons');
        }
        $categories = Category::get();
        $categories = json_decode(json_encode($categories), true);

        $users = User::select('email')->where('role_as', '0')->get();
        return view('admin.add_edit_coupon', compact('coupon', 'title', 'categories', 'users','selCats','selUsers'));
    }
    public function deleteCoupon(Request $request){
        $idCoupon = $request->input('idCoupon');
        if (Coupons::where('_id', $idCoupon)->exists()) {
            $coupon = Coupons::where('_id', $idCoupon)->first();
            $coupon->delete();
            return response()->json(['status' => "Coupon Deleted Successfully"]);
        }
    }
}
