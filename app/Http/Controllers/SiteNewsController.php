<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\Product;
use App\Models\Branch;

class SiteNewsController extends Controller
{

    public function index()
    {
        $nsx = DB::collection('nhasanxuat');
        $nsx = $nsx->get();
        $dt = DB::collection('dienthoai');
        $dt = $dt->paginate(6);
        $branch = Branch::all();
        return view('/home', compact('nsx', 'dt','branch'));
    }

    public function productview($slugcat, $slug)
    {
        if (Category::where('slugcat', $slugcat)->exists()) {
            if (Product::where('slug', $slug)->exists()) {
                $nsx = DB::collection('nhasanxuat');
                $nsx = $nsx->get();
                $products = Product::where('slug', $slug)->first();
                return view('/product-detail', compact('products', 'nsx'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }

    public function viewcategory($slugcat)
    {
        if (Category::where('slugcat', $slugcat)->exists()) {
            $nsx = DB::collection('nhasanxuat');
            $nsx = $nsx->get();
            $category = Category::where('slugcat', $slugcat)->first();
            $products = DB::collection('dienthoai');
            $products = $products->get()->where('idNSX', $category['_id']);
            return view('/productbycat', compact('category', 'products', 'nsx'));
        } else {
            $nsx = DB::collection('nhasanxuat');
            $nsx = $nsx->get();
            $products = Product::where('slug', $slugcat)->first();
            return view('/product-detail', compact('products', 'nsx'));
        }
    }
}
