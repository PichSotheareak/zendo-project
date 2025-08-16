<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        // Fetch all cart items for user 1
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
            ->where('user_cart.user_id', 1)
            ->get();

        return view('cart', [
            'user_cart' => $userCart
        ]);
    }

    public function remove($id)
{
    DB::table('user_cart')->where('id', $id)->delete();
    return redirect()->back();
}


    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $existingCartItem = DB::table('user_cart')
            ->where('user_id', 1)
            ->where('product_id', $productId)
            ->first();

        if ($existingCartItem) {
            DB::table('user_cart')
                ->where('id', $existingCartItem->id)
                ->update(['qty' => $existingCartItem->qty + $quantity]);
        } else {
            DB::table('user_cart')->insert([
                'user_id' => 1,
                'product_id' => $productId,
                'qty' => $quantity,
            ]);
        }

        return response()->json([
            'cart_list' => DB::table('user_cart')
                ->join('products', 'user_cart.product_id', '=', 'products.id')
                ->select(
                    'user_cart.id as cart_id',
                    'products.id as product_id',
                    'products.name',
                    'products.price',
                    'products.image',
                    'user_cart.qty'
                )
                ->where('user_cart.user_id', 1)
                ->get(),
            'status' => 'success',
            'message' => 'Product added to cart successfully.'
        ]);
    }
}
