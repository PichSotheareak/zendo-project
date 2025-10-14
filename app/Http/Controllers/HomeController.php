<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Get the current authenticated user ID
     * Returns null if user is not authenticated
     */
    private function getUserId()
    {
        return Auth::check() ? Auth::id() : null;
    }

    /**
     * Get cart count for authenticated user
     * Returns 0 if user is not authenticated
     */
    private function getCartCount()
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return 0;
        }

        return DB::table('user_cart')
            ->where('user_id', $userId)
            ->sum('qty');
    }

    public function index()
    {
        $discount20_50 = DB::table('product')
            ->whereBetween('discount', [20, 50])
            ->get();

        $discount51_80 = DB::table('product')
            ->whereBetween('discount', [51, 80])
            ->get();

        $cart_count = $this->getCartCount();

        // Get user data if authenticated
        $user = Auth::user();

        return view('frontend.index', [
            'discount20_50' => $discount20_50,
            'discount51_80' => $discount51_80,
            'cart_count' => $cart_count,
            'user' => $user,
        ]);
    }

    public function shop(Request $request)
    {
        $query = DB::table('product');

        // ✅ Optional discount filter from URL, e.g., ?discount=20-50
        if ($request->has('discount')) {
            $discountRange = explode('-', $request->discount);
            if (count($discountRange) == 2) {
                $query->whereBetween('discount', [(int)$discountRange[0], (int)$discountRange[1]]);
            }
        }

        // ✅ Sorting (from ?sort=price_high, price_low, discount_high, etc.)
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'new':
                    $query->orderBy('id', 'desc'); // assuming "id" means newest
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'discount_high':
                    $query->orderBy('discount', 'desc');
                    break;
                case 'discount_low':
                    $query->orderBy('discount', 'asc');
                    break;
            }
        }

        // ✅ Pagination
        $products = $query->paginate(12)->appends($request->query());
        // keep query params in pagination links

        $count = $products->total();
        $cart_count = $this->getCartCount();
        $user = Auth::user();

        return view('frontend.shop', [
            'products' => $products,
            'count' => $count,
            'cart_count' => $cart_count,
            'user' => $user,
        ]);
    }

    public function productDetail($id)
    {
        $product = DB::table('product')->where('id', $id)->first();

        if (!$product) {
            abort(404);
        }

        $cart_count = $this->getCartCount();
        $user = Auth::user();

        return view('frontend.productDetail', [
            'product' => $product,
            'cart_count' => $cart_count,
            'user' => $user,
        ]);
    }
}
