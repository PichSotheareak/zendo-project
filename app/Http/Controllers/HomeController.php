<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $userId = 1;

    public function index()
    {
        $discount20_50 = DB::table('product')
            ->whereBetween('discount', [20, 50])
            ->get();
        $discount51_80 = DB::table('product')
            ->whereBetween('discount', [51, 80])
            ->get();
        $cart_count = DB::table('user_cart')
            ->where('user_id', $this->userId)
            ->sum('qty');

        return view('frontend.index',
            [
                'discount20_50' => $discount20_50,
                'discount51_80' => $discount51_80,
                'cart_count' => $cart_count,
            ]);

    }

    public function shop(Request $request)
    {
        $query = DB::table('product');

        // Optional discount filter from URL, e.g., ?discount=20-50
        if ($request->has('discount')) {
            $discountRange = explode('-', $request->discount);
            if (count($discountRange) == 2) {
                $query->whereBetween('discount', [(int)$discountRange[0], (int)$discountRange[1]]);
            }
        }

        $products = $query->get();
        $count = $products->count();


        $cart_count = DB::table('user_cart')
            ->where('user_id', $this->userId)
            ->sum('qty');

        return view('frontend.shop', [
            'products' => $products,
            'count' => $count,
            'cart_count' => $cart_count,
        ]);
    }

    public function productDetail($id)
    {

        $product = DB::table('product')->where('id', $id)->first();

        if (!$product) {

            abort(404);
        }


        $cart_count = DB::table('user_cart')
            ->where('user_id', $this->userId)
            ->sum('qty');

        return view('frontend.productDetail', [
            'product' => $product,
            'cart_count' => $cart_count,
        ]);
    }
}
