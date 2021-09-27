<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Product;
use App\Models\Branch;
use App\Models\Blog;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    //show home page
    public function index()
    {
        $dt = DB::collection('dienthoai');
        $dt = $dt->paginate(6);
        $branch = Branch::all();
        $posts = Blog::orderBy('updated_at', 'DESC')->limit(3)->get();
        return view('/home', compact('dt', 'branch', 'posts'));
    }

    //show product details
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

    //show Product by Category
    public function viewcategory($slugcat)
    {
        if (Category::where('slugcat', $slugcat)->exists()) {
            $category = Category::where('slugcat', $slugcat)->first();
            $products = DB::collection('dienthoai');
            $products = $products->get()->where('idNSX', $category['_id']);
            return view('/productbycat', compact('category', 'products'));
        } else {
            $products = Product::where('slug', $slugcat)->first();
            return view('/product-detail', compact('products'));
        }
    }
    public function contactForm(Request $request)
    {
        $email = $request->input('email');
        $message = $request->input('message');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['status' => "1"]);
        } elseif ($message == '') {
            return response()->json(['status' => "2"]);
        }
        $query = Contact::create([
            'email' => $request->input('email'),
            'message' => $request->input('message')
        ]);

        if ($query) {
            $data = ['email' => $request->input('email'), 'msg' => $request->input('message')];
            $user['to'] = 'tranhao050598@gmail.com';
            Mail::send(
                'email/email_contact',
                $data,
                function ($messages) use ($user) {
                    $messages->to($user['to']);
                    $messages->subject('HPhone Website [Quick Contact]');
                }
            );
        }
        return response()->json(['status' => "3",'view' => (string)View::make('includes.contact_form')]);
    }
}
