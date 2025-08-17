<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $discount20_50 = DB::table('product')
            ->whereBetween('discount', [20, 50])
            ->get();

        $discount51_80 = DB::table('product')
            ->whereBetween('discount', [51, 80])
            ->get();

        return view('index', [
            'discount20_50' => $discount20_50,
            'discount51_80' => $discount51_80,
        ]);
    }

    public function shop(Request $request)
    {
        $query = DB::table('product');

        // Optional discount filter from URL, e.g., ?discount=20-50
        if ($request->has('discount')) {
            $discountRange = explode('-', $request->discount); // ["20", "50"]
            if (count($discountRange) == 2) {
                $query->whereBetween('discount', [(int)$discountRange[0], (int)$discountRange[1]]);
            }
        }

        $products = $query->get();       // Get filtered or all products
        $count = $products->count();     // Total count of returned products

        return view('shop', [
            'products' => $products,
            'count' => $count,
        ]);
    }
    public function productDetail($id){
        // Get the product by ID
        $product = DB::table('product')->where('id', $id)->first();

        if (!$product) {
            // Redirect back or show 404 if product not found
            abort(404);
        }

        return view('productDetail', [
            'product' => $product,
        ]);
    }


}
