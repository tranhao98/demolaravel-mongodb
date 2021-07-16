<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    public function branchDetail($slugbranch){
        if (Branch::where('slug', $slugbranch)->exists()) {
            $branch = Branch::where('slug', $slugbranch)->first();
            $products = Product::all();
            return view('/branch-details', compact('branch','products'));
        }
    }
}
