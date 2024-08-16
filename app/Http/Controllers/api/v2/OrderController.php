<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $customer_id = $user->id;

        $orders = Order::where('customer_id', $customer_id)
                ->orderBy('id', 'asc')
                ->get();
            
        return response()->json(['data' => $orders], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $customer_id = $user->id;

        // Validate the request
        $validatedData = $request->validate([
            'order_items' => 'required|array',
            'order_items.*.product_id' => 'required|exists:products,id',
            'order_items.*.qty' => 'required|integer|min:1',
            'order_items.*.unit_price' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $order = Order::create([
                'customer_id' => $customer_id,
                'total_amount' => 0, // Will be calculated
                'order_status' => 'pending',
                'payment_method' => $validatedData['payment_method'],
            ]);

            $totalAmount = 0;

            foreach ($validatedData['order_items'] as $item) {
                $amount = $item['qty'] * $item['unit_price'];
                $totalAmount += $amount;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'unit_price' => $item['unit_price'],
                    'amount' => $amount,
                    'discount' => 0
                ]);
            }

            $order->update(['total_amount' => $totalAmount]);

            // Clear the cart
            $user->cartItems()->delete();

            DB::commit();

            return response()->json(['data' => $order->load('orderItems')], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Order creation failed', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()->json(['data' => $order->load('orderItems')], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}