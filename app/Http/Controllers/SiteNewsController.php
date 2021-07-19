<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\Product;
use App\Models\Branch;
use App\Models\Blog;

class SiteNewsController extends Controller
{

    public function index()
    {
        $dt = DB::collection('dienthoai');
        $dt = $dt->paginate(6);
        $branch = Branch::all();
        $posts = Blog::orderBy('updated_at','DESC')->get();
        return view('/home', compact( 'dt','branch','posts'));
    }

    public function productview($slugcat, $slug)
    {
        if (Category::where('slugcat', $slugcat)->exists()) {
            if (Product::where('slug', $slug)->exists()) {
                $products = Product::where('slug', $slug)->first();
                return view('/product-detail', compact('products'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
    public function viewcategory($slugcat)
    {
        if (Category::where('slugcat', $slugcat)->exists()){
            $category = Category::where('slugcat', $slugcat)->first();
            $products = DB::collection('dienthoai');
            $products = $products->get()->where('idNSX', $category['_id']);
            return view('/productbycat', compact('category', 'products'));
        } else {
            $products = Product::where('slug', $slugcat)->first();
            return view('/product-detail', compact('products'));
        }
    }
}
