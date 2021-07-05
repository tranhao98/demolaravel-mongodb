<?php

namespace App\Http\Controllers;

use App\Models\infoUser;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin');
    }

    public function updateStatus(Request $request)
    {

        $status = $request->input('status');
        $idOrder = $request->input('idOrder');

        $updateStatus = infoUser::where('_id', $idOrder)->first();
        $updateStatus['status'] = $status;
        $updateStatus->save();

        return response()->json(['status' => "Status has been changed!"]); 
    }
}
