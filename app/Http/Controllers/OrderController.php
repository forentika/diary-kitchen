<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^[0-9]{10,15}$/',
            'address' => 'nullable|string',
            'order_type' => 'required|in:take_away,dine_in',
            'table_number' => 'required_if:order_type,dine_in|nullable|integer',
            'orderItems' => 'required|array',
            'orderItems.*.product_id' => 'required|exists:products,id',
            'orderItems.*.quantity' => 'required|integer|min:1',
        ], [
            'phone.regex' => 'Nomor telepon harus berupa 10-15 digit angka.',
            'orderItems.required' => 'Pesanan harus memiliki minimal 1 item.',
            'table_number.required_if' => 'Nomor meja wajib diisi untuk pesanan dine-in.',
        ]);

        // Hitung total harga
        $total_price = 0;
        foreach ($request->orderItems as $item) {
            $product = Product::find($item['product_id']);
            $total_price += $product->price * $item['quantity'];
        }

        // Buat order baru
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'order_type' => $request->order_type,
            'table_number' => $request->table_number,
            'total_price' => $total_price,
            'status' => Order::STATUS_PENDING
        ]);

        // Simpan item pesanan
        foreach ($request->orderItems as $item) {
            $product = Product::find($item['product_id']);
            $order->orderItems()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $product->price
            ]);
        }

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat!');
    }
}
