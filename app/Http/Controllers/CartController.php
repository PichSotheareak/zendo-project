<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    private $userId = 1; // You should get this from Auth::id() in production

    public function index()
    {
        try {
            // Get cart items with product details
            $cart_items = DB::table('user_cart')
                ->join('product', 'user_cart.product_id', '=', 'product.id')
                ->where('user_cart.user_id', $this->userId)
                ->select(
                    'user_cart.id as cart_id',
                    'user_cart.product_id',
                    'user_cart.qty as quantity',
                    'product.name',
                    'product.price',
                    'product.image',
                    'product.discount',
                    DB::raw('CASE WHEN product.discount > 0
                        THEN product.price - (product.price * product.discount / 100)
                        ELSE product.price END as final_price')
                )
                ->get();

            $cart_count = $cart_items->sum('quantity');
            $cart_total = $cart_items->sum(function($item) {
                return $item->final_price * $item->quantity;
            });

            return view('frontend.cart', [
                'cart_items' => $cart_items,
                'cart_count' => $cart_count,
                'cart_total' => $cart_total
            ]);

        } catch (\Exception $e) {
            Log::error('Cart Index Error: ' . $e->getMessage());
            return redirect()->route('shop')->with('error', 'Unable to load cart. Please try again.');
        }
    }

    public function addToCart(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_id' => 'required|integer|exists:product,id',
                'quantity' => 'required|integer|min:1|max:99'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid product or quantity'
                ], 400);
            }

            $productId = $request->product_id;
            $quantity = $request->quantity;

            // Check if item already exists in cart
            $existingCartItem = DB::table('user_cart')
                ->where('user_id', $this->userId)
                ->where('product_id', $productId)
                ->first();

            if ($existingCartItem) {
                // Update existing item
                DB::table('user_cart')
                    ->where('id', $existingCartItem->id)
                    ->update([
                        'qty' => $existingCartItem->qty + $quantity,
                        'updated_at' => now()
                    ]);
            } else {
                // Create new cart item
                DB::table('user_cart')->insert([
                    'user_id' => $this->userId,
                    'product_id' => $productId,
                    'qty' => $quantity,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Get updated cart count
            $cart_count = DB::table('user_cart')
                ->where('user_id', $this->userId)
                ->sum('qty');

            return response()->json([
                'success' => true,
                'message' => 'Item added to cart successfully',
                'cart_count' => $cart_count
            ]);

        } catch (\Exception $e) {
            Log::error('Add to Cart Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Unable to add item to cart'
            ], 500);
        }
    }

    public function updateQuantity(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required|integer',
            'quantity' => 'required|integer|min:1|max:99'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid quantity'
            ], 400);
        }

        $updated = DB::table('user_cart')
            ->where('id', $request->cart_id)
            ->where('user_id', $this->userId)
            ->update([
                'qty' => $request->quantity,
                'updated_at' => now()
            ]);

        if (!$updated) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found'
            ], 404);
        }

        // Get updated cart count
        $cart_count = DB::table('user_cart')
            ->where('user_id', $this->userId)
            ->sum('qty');

        return response()->json([
            'success' => true,
            'message' => 'Quantity updated successfully',
            'cart_count' => $cart_count
        ]);

    } catch (\Exception $e) {
        Log::error('Update Cart Quantity Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Unable to update quantity'
        ], 500);
    }
}

    public function removeItem($cartId)
    {
        try {
            $deleted = DB::table('user_cart')
                ->where('id', $cartId)
                ->where('user_id', $this->userId)
                ->delete();

            if (!$deleted) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item not found in cart'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart'
            ]);

        } catch (\Exception $e) {
            Log::error('Remove Cart Item Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Unable to remove item'
            ], 500);
        }
    }

    public function clearCart()
    {
        try {
            DB::table('user_cart')
                ->where('user_id', $this->userId)
                ->delete();

            return redirect()->route('cart')->with('success', 'Cart cleared successfully');

        } catch (\Exception $e) {
            Log::error('Clear Cart Error: ' . $e->getMessage());
            return redirect()->route('cart')->with('error', 'Unable to clear cart');
        }
    }

    public function empty()
    {
        return view('frontend.cart-empty');
    }
}

class CheckoutController extends Controller
{
    private $userId = 1; // You should get this from Auth::id() in production

    public function index(Request $request)
    {
        try {
            // Get selected cart items
            $selectedCartIds = $request->input('selected_items', []);

            if (empty($selectedCartIds)) {
                return redirect()->route('cart')->with('error', 'Please select items to checkout');
            }

            // Get selected cart items with product details
            $cart_items = DB::table('user_cart')
                ->join('product', 'user_cart.product_id', '=', 'product.id')
                ->where('user_cart.user_id', $this->userId)
                ->whereIn('user_cart.id', $selectedCartIds)
                ->select(
                    'user_cart.id as cart_id',
                    'user_cart.product_id',
                    'user_cart.qty as quantity',
                    'product.name',
                    'product.price',
                    'product.image',
                    'product.discount',
                    DB::raw('CASE WHEN product.discount > 0
                        THEN product.price - (product.price * product.discount / 100)
                        ELSE product.price END as final_price')
                )
                ->get();

            if ($cart_items->isEmpty()) {
                return redirect()->route('cart.empty');
            }

            // Convert to array format expected by your checkout view
            $cart_items_array = $cart_items->map(function($item) {
                return [
                    'cart_id' => $item->cart_id,
                    'product_id' => $item->product_id,
                    'name' => $item->name,
                    'price' => $item->final_price,
                    'quantity' => $item->quantity,
                    'image' => $item->image
                ];
            })->toArray();

            return view('frontend.checkout', [
                'cart_items' => $cart_items_array,
                'selected_cart_ids' => $selectedCartIds
            ]);

        } catch (\Exception $e) {
            Log::error('Checkout Index Error: ' . $e->getMessage());
            return redirect()->route('checkout.error');
        }
    }

    public function processOrder(Request $request)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:500',
                'payment_method' => 'required|in:cod,credit,bank_transfer',
                'notes' => 'nullable|string|max:1000',
                'selected_cart_ids' => 'required|array',
                'selected_cart_ids.*' => 'integer|exists:user_cart,id'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Get cart items for the order
            $cartItems = DB::table('user_cart')
                ->join('product', 'user_cart.product_id', '=', 'product.id')
                ->where('user_cart.user_id', $this->userId)
                ->whereIn('user_cart.id', $request->selected_cart_ids)
                ->select(
                    'user_cart.id as cart_id',
                    'user_cart.product_id',
                    'user_cart.qty as quantity',
                    'product.price',
                    'product.discount',
                    DB::raw('CASE WHEN product.discount > 0
                        THEN product.price - (product.price * product.discount / 100)
                        ELSE product.price END as final_price')
                )
                ->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart')->with('error', 'No items found for checkout');
            }

            // Calculate totals
            $subtotal = $cartItems->sum(function($item) {
                return $item->final_price * $item->quantity;
            });

            $shipping = $subtotal >= 2.00 ? 0 : 2.00;
            $total = $subtotal + $shipping;

            // Create order
            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $this->userId,
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'payment_method' => $request->payment_method,
                'notes' => $request->notes,
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $total,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->final_price,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Remove items from cart
            DB::table('user_cart')
                ->whereIn('id', $request->selected_cart_ids)
                ->delete();

            DB::commit();

            return redirect()->route('order.success', $orderId)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order Processing Error: ' . $e->getMessage());
            return redirect()->route('checkout.error')
                ->with('error', 'Unable to process order. Please try again.');
        }
    }

    public function error()
    {
        return view('frontend.checkout-error');
    }

    public function orderSuccess($orderId)
    {
        try {
            $order = DB::table('orders')
                ->where('id', $orderId)
                ->where('user_id', $this->userId)
                ->first();

            if (!$order) {
                return redirect()->route('shop')->with('error', 'Order not found');
            }

            return view('frontend.order-success', compact('order'));

        } catch (\Exception $e) {
            Log::error('Order Success Error: ' . $e->getMessage());
            return redirect()->route('shop')->with('error', 'Unable to display order details');
        }
    }
}
