<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\infoUser;
use App\Models\User;

class OrdersController extends Controller
{
    public function index()
    {
        $nsx = DB::collection('nhasanxuat');
        $nsx = $nsx->get();
        $orders = infoUser::where('idUser', Auth::id())->get();

        return view('orders', compact('nsx', 'orders'));
    }

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
    public function ordersAdmin(){
        $orders = infoUser::all();
        // dd($orders); die;
        return view('admin.orders', compact('orders'));
    }
    public function ordersDetails($id){
        $ordersDetails = infoUser::where('_id', $id)->first();
        
        $orderItems = infoUser::where('_id', $id)->get();

        $userDetails = User::where('_id', $ordersDetails['idUser'])->first();
        
        return view('admin.order_details', compact('ordersDetails','orderItems','userDetails'));
    }
}
