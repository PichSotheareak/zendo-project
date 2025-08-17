<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    private $userId = 1;


    public function index()
    {
        $userCart = DB::table('user_cart')
            ->join('product', 'user_cart.product_id', '=', 'product.id')
            ->select(
                'user_cart.id as cart_id',
                'product.id as product_id',
                'product.name',
                'product.price',
                'product.image',
                'user_cart.qty'
            )
            ->where('user_cart.user_id', $this->userId)
            ->get();

        $cart_count = $userCart->sum('qty');

        return view('cart', [
            'user_cart' => $userCart,
            'cart_count' => $cart_count
        ]);
    }


    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:product,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);


        $existingCartItem = DB::table('user_cart')
            ->where('user_id', $this->userId)
            ->where('product_id', $productId)
            ->first();

        if ($existingCartItem) {
            DB::table('user_cart')
                ->where('id', $existingCartItem->id)
                ->update(['qty' => $existingCartItem->qty + $quantity]);
        } else {
            DB::table('user_cart')->insert([
                'user_id' => $this->userId,
                'product_id' => $productId,
                'qty' => $quantity,
            ]);
        }


        $cart_list = DB::table('user_cart')
            ->join('product', 'user_cart.product_id', '=', 'product.id')
            ->select(
                'user_cart.id as cart_id',
                'product.id as product_id',
                'product.name',
                'product.price',
                'product.image',
                'user_cart.qty'
            )
            ->where('user_cart.user_id', $this->userId)
            ->get();

        $cart_count = $cart_list->sum('qty');

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart successfully.',
            'cart_list' => $cart_list,
            'cart_count' => $cart_count
        ]);
    }


    public function remove($id)
    {
        DB::table('user_cart')->where('id', $id)->delete();
        return redirect()->back();
    }


    public function getCartCount()
    {
        $cart_count = DB::table('user_cart')
            ->where('user_id', $this->userId)
            ->sum('qty');

        return response()->json([
            'cart_count' => $cart_count
        ]);
    }
}
