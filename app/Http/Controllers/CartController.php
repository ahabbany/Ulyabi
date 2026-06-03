<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $items = collect();
        $total = 0;

        if (count($cart) > 0) {
            $productIds = collect($cart)->pluck('product_id')->unique()->values()->toArray();
            $products = Product::with('subcategory.category')
                ->whereIn('id', $productIds)
                ->get()
                ->keyBy('id');

            $variantIds = collect($cart)->pluck('variant_id')->filter()->unique()->values()->toArray();
            $variants = ProductVariant::whereIn('id', $variantIds)->get()->keyBy('id');

            foreach ($cart as $key => $item) {
                $product = $products[$item['product_id']] ?? null;
                if (!$product) continue;

                $variant = null;
                $itemPrice = $product->price;
                $variantName = '';

                if ($item['variant_id'] > 0 && isset($variants[$item['variant_id']])) {
                    $variant = $variants[$item['variant_id']];
                    $itemPrice += $variant->additional_price;
                    $variantName = $variant->name;
                }

                $subtotal = $itemPrice * $item['quantity'];
                $total += $subtotal;

                $items->push((object) [
                    'key' => $key,
                    'product' => $product,
                    'variant' => $variant,
                    'variant_name' => $variantName,
                    'quantity' => $item['quantity'],
                    'item_price' => $itemPrice,
                    'subtotal' => $subtotal,
                ]);
            }
        }

        return view('cart.index', compact('items', 'total'));
    }

    public function add()
    {
        $data = request()->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'nullable|integer|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $productId = $data['product_id'];
        $variantId = (int) ($data['variant_id'] ?? 0);
        $quantity = (int) $data['quantity'];

        $key = $productId . '_' . $variantId;

        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $quantity;
        } else {
            $cart[$key] = [
                'product_id' => $productId,
                'variant_id' => $variantId,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update()
    {
        $data = request()->validate([
            'key' => 'required|string',
            'quantity' => 'required|integer|min:0',
        ]);

        $cart = session()->get('cart', []);

        if ($data['quantity'] < 1) {
            unset($cart[$data['key']]);
        } else {
            $cart[$data['key']]['quantity'] = $data['quantity'];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui!');
    }

    public function remove()
    {
        $data = request()->validate([
            'key' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        unset($cart[$data['key']]);
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (count($cart) < 1) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja masih kosong!');
        }

        $productIds = collect($cart)->pluck('product_id')->unique()->values()->toArray();
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $variantIds = collect($cart)->pluck('variant_id')->filter()->unique()->values()->toArray();
        $variants = ProductVariant::whereIn('id', $variantIds)->get()->keyBy('id');

        $total = 0;
        $items = [];

        foreach ($cart as $item) {
            $product = $products[$item['product_id']] ?? null;
            if (!$product) continue;

            $itemPrice = $product->price;
            $variantLabel = '';

            if ($item['variant_id'] > 0 && isset($variants[$item['variant_id']])) {
                $variant = $variants[$item['variant_id']];
                $itemPrice += $variant->additional_price;
                $variantLabel = ' (' . $variant->name . ')';
            }

            $subtotal = $itemPrice * $item['quantity'];
            $total += $subtotal;

            $items[] = "- {$product->name}{$variantLabel} x{$item['quantity']} = Rp" . number_format($subtotal, 0, ',', '.');
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
