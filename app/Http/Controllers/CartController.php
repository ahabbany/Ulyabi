<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $products = [];
        $total = 0;

        if (count($cart) > 0) {
            $ids = array_keys($cart);
            $products = Product::with('subcategory.category')
                ->whereIn('id', $ids)
                ->get()
                ->map(function ($product) use ($cart) {
                    $product->cart_quantity = $cart[$product->id];
                    $product->subtotal = $product->price * $cart[$product->id];
                    return $product;
                });

            $total = $products->sum('subtotal');
        }

        return view('cart.index', compact('products', 'total'));
    }

    public function add()
    {
        $data = request()->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        $productId = $data['product_id'];
        $quantity = $data['quantity'];

        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update()
    {
        $data = request()->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $cart = session()->get('cart', []);
        $productId = $data['product_id'];

        if ($data['quantity'] < 1) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $data['quantity'];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui!');
    }

    public function remove()
    {
        $data = request()->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cart = session()->get('cart', []);
        unset($cart[$data['product_id']]);
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (count($cart) < 1) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja masih kosong!');
        }

        $ids = array_keys($cart);
        $products = Product::whereIn('id', $ids)->get();
        $total = 0;
        $items = [];

        foreach ($products as $product) {
            $qty = $cart[$product->id];
            $subtotal = $product->price * $qty;
            $total += $subtotal;

            $items[] = "- {$product->name} x{$qty} = Rp" . number_format($subtotal, 0, ',', '.');
        }

        $message = "Halo Ulyabi, saya ingin memesan:\n\n";
        $message .= implode("\n", $items);
        $message .= "\n\nTotal: Rp" . number_format($total, 0, ',', '.');

        $phone = '6285600552040';
        $url = "https://wa.me/{$phone}?text=" . urlencode($message);

        session()->forget('cart');

        return redirect()->away($url);
    }
}
