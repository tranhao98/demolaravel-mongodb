<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\Product;

class SiteNewsController extends Controller
{

    public function index()
    {
        $nsx = DB::collection('nhasanxuat');
        $nsx = $nsx->get();
        $dt = DB::collection('dienthoai');
        $dt = $dt->paginate(6);
        return view('/home', compact('nsx', 'dt'));
    }

    public function show($slug)
    {
       
        if (Category::where('slug', $slug)->exists()) {
            $nsx = DB::collection('nhasanxuat');
            $nsx = $nsx->get();
            $category = Category::where('slug', $slug)->first();
            $products = Product::where('idNSX', $category['_id'])->where('status', '0')->get();
            return view('/productbycat', compact('category', 'products','nsx'));
        } else {
            $nsx = DB::collection('nhasanxuat');
            $nsx = $nsx->get();
            $productDetail = DB::collection('dienthoai')->where('slug', '=', $slug);
            $productDetail = $productDetail->first();
            return view('/product-detail', compact('productDetail', 'nsx'));
        }
    }
}
