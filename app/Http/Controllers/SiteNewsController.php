<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SiteNewsController extends Controller
{
    public function index()
    {
        $nsx = DB::collection('nhasanxuat');
        $nsx = $nsx->get();
        $dt = DB::collection('dienthoai');
        $dt = $dt->get();
        return view('/home', compact('nsx','dt'));
    }
    
    public function show($slug)
    {
        $nsx = DB::collection('nhasanxuat');
        $nsx = $nsx->get();
        $productDetail = DB::collection('dienthoai')->where('slug', '=', $slug);
        $productDetail = $productDetail->first();
        return view('/product-detail', compact('productDetail','nsx'));
    }
}
