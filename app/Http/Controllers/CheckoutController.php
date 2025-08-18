<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    private $userId = 1;

    public function index(Request $request)
    {
        $selectedCartIds = $request->input('selected_products', []);

        // If no items selected, redirect back to cart
        if (empty($selectedCartIds)) {
            return redirect()->route('cart')->with('error', 'Please select at least one item to checkout.');
        }

        // Validate that selected cart IDs exist and belong to user
        $validCartIds = DB::table('user_cart')
            ->where('user_id', $this->userId)
            ->whereIn('id', $selectedCartIds)
            ->pluck('id')
            ->toArray();

        if (empty($validCartIds)) {
            return redirect()->route('cart')->with('error', 'Selected items are no longer available.');
        }

        // Get selected cart items using valid IDs
        $selectedItems = DB::table('user_cart')
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
            ->whereIn('user_cart.id', $validCartIds)
            ->get();

        // Calculate totals
        $subtotal = $selectedItems->sum(function($item) {
            return $item->price * $item->qty;
        });

        $tax = $subtotal * 0.10; // 10% tax
        $shipping = $subtotal > 50 ? 0 : 10; // Free shipping over $50
        $total = $subtotal + $tax + $shipping;

        return view('frontend.checkout', [
            'selected_items' => $selectedItems,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => $total,
            'selected_cart_ids' => $validCartIds
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'payment_method' => 'required|in:cod,credit,bank_transfer',
        ]);

        $selectedCartIds = $request->input('selected_cart_ids', []);

        if (empty($selectedCartIds)) {
            return redirect()->route('cart')->with('error', 'No items selected for checkout.');
        }

        try {
            DB::beginTransaction();

            // Get selected items for order
            $selectedItems = DB::table('user_cart')
                ->join('product', 'user_cart.product_id', '=', 'product.id')
                ->select(
                    'user_cart.id as cart_id',
                    'product.id as product_id',
                    'product.name',
                    'product.price',
                    'user_cart.qty'
                )
                ->where('user_cart.user_id', $this->userId)
                ->whereIn('user_cart.id', $selectedCartIds)
                ->get();

            // Calculate total
            $subtotal = $selectedItems->sum(function($item) {
                return $item->price * $item->qty;
            });

            $tax = $subtotal * 0.10;
            $shipping = $subtotal > 50 ? 0 : 10;
            $total = $subtotal + $tax + $shipping;

            // Create order
            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $this->userId,
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'notes' => $request->notes,
                'payment_method' => $request->payment_method,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping' => $shipping,
                'total' => $total,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Create order items
            foreach ($selectedItems as $item) {
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $item->product_id,
                    'product_name' => $item->name,
                    'price' => $item->price,
                    'quantity' => $item->qty,
                    'total' => $item->price * $item->qty,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Remove ordered items from cart
            DB::table('user_cart')
                ->whereIn('id', $selectedCartIds)
                ->delete();

            DB::commit();

            return redirect()->route('order.success', $orderId)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to process order. Please try again.');
        }
    }

    public function processOrder(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'payment_method' => 'required|in:cod,credit,bank_transfer',
        ]);

        $selectedCartIds = $request->input('selected_cart_ids', []);

        if (empty($selectedCartIds)) {
            return redirect()->route('cart')->with('error', 'No items selected for checkout.');
        }

        try {
            DB::beginTransaction();

            // Get selected items for order
            $selectedItems = DB::table('user_cart')
                ->join('product', 'user_cart.product_id', '=', 'product.id')
                ->select(
                    'user_cart.id as cart_id',
                    'product.id as product_id',
                    'product.name',
                    'product.price',
                    'user_cart.qty'
                )
                ->where('user_cart.user_id', $this->userId)
                ->whereIn('user_cart.id', $selectedCartIds)
                ->get();

            // Calculate total
            $subtotal = $selectedItems->sum(function($item) {
                return $item->price * $item->qty;
            });

            $tax = $subtotal * 0.10;
            $shipping = $subtotal > 50 ? 0 : 10;
            $total = $subtotal + $tax + $shipping;

            // Create order
            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $this->userId,
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'notes' => $request->notes,
                'payment_method' => $request->payment_method,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping' => $shipping,
                'total' => $total,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Create order items
            foreach ($selectedItems as $item) {
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $item->product_id,
                    'product_name' => $item->name,
                    'price' => $item->price,
                    'quantity' => $item->qty,
                    'total' => $item->price * $item->qty,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Remove ordered items from cart
            DB::table('user_cart')
                ->whereIn('id', $selectedCartIds)
                ->delete();

            DB::commit();

            return redirect()->route('order.success', $orderId)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to process order. Please try again.');
        }
    }

    public function orderSuccess($orderId)
    {
        $order = DB::table('orders')->where('id', $orderId)->first();

        if (!$order) {
            return redirect()->route('cart')->with('error', 'Order not found.');
        }

        $orderItems = DB::table('order_items')->where('order_id', $orderId)->get();

        return view('frontend.order-success', [
            'order' => $order,
            'order_items' => $orderItems
        ]);
    }
}
