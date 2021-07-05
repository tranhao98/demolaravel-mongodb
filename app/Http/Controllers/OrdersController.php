<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\infoUser;

class OrdersController extends Controller
{
    public function vieworders(){
        $nsx = DB::collection('nhasanxuat');
        $nsx = $nsx->get();
        $orders = infoUser::where('idUser', Auth::id())->get();

        return view('orders', compact('orders','nsx'));
    }
    public function orderview($id){
        // $nsx = DB::collection('nhasanxuat');
        // $nsx = $nsx->get();
        // $ordDetails = infoUser::where('_id', $id)->first();
        // return view('orders-details',compact('nsx','ordDetails'));
    }
}
