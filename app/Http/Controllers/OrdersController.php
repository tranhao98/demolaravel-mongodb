<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\infoUser;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    //Orders in client
    public function index()
    {
        $nsx = DB::collection('nhasanxuat');
        $nsx = $nsx->get();
        $orders = infoUser::where('idUser', Auth::id())->get();

        return view('orders', compact('nsx', 'orders'));
    }
    //show order detail
    public function orderDetail($id)
    {
        if (infoUser::where('_id', $id)->exists()) {
            $nsx = DB::collection('nhasanxuat');
            $nsx = $nsx->get();

            $ordersDetails = infoUser::where('_id', $id)->first();

            $orderItems = infoUser::where('_id', $id)->where('idUser', Auth::id())->get();
            // dd($orderItems); die;

            return view('orders-details', compact('ordersDetails','orderItems', 'nsx'));
        }
    }
    //End Orders in Client


    // Manage Orders in ADMIN
    public function ordersAdmin(){
        Session::put('page','orders');
        $orders = infoUser::all();
        // dd($orders); die;
        return view('admin.orders', compact('orders'));
    }
    public function ordersDetailsAdmin($id){
        $ordersDetails = infoUser::where('_id', $id)->first();
        
        $orderItems = infoUser::where('_id', $id)->get();

        $userDetails = User::where('_id', $ordersDetails['idUser'])->first();
        
        return view('admin.order_details', compact('ordersDetails','orderItems','userDetails'));
    }
    public function updateOrderStatus(Request $request)
    {

        $status = $request->input('status');
        $idOrder = $request->input('idOrder');

        $updateStatus = infoUser::where('_id', $idOrder)->first();
        $updateStatus['status'] = $status;
        $updateStatus->save();

        return response()->json(['status' => "Status has been changed!"]); 
    }
}
