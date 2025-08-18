<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $data = DB::table('user_cart')
            ->select('*')
            ->where('user_id', 1)
            ->get();

        return view('frontend.cart', [
            'cart'=>$data,
        ]);
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        // Check if the product already exists in the cart
        $existingCartItem = DB::table('user_cart')
            ->where('user_id', 1)
            ->where('product_id', $productId)
            ->first();

        if ($existingCartItem) {
            // Update the quantity if it already exists
            DB::table('user_cart')
                ->where('id', $existingCartItem->id)
                ->update(['qty' => $existingCartItem->qty + $quantity]);
        } else {
            // Insert a new item into the cart
            DB::table('user_cart')->insert([
                'user_id' => 1,
                'product_id' => $productId,
                'qty' => $quantity,
            ]);
        }

        return response()->json([
            'cart_list'=> DB::table('user_cart')
                ->where('user_id', 1)->get(),
            'status' => 'success',
            'message' => 'Product added to cart successfully.',
        ]);

    }
}
