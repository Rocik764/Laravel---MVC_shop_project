<?php

namespace App\Http\Controllers;

use App\Models\CartItems;
use App\Models\Product;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function showCart() {
        $user = auth()->user();
        $cart = CartItems::query()->with('product')->where('user_id', $user->id)->get();
        if ($cart->isEmpty()) return view('user.shopping_cart')->with('info', 'Brak produktów w koszyku.');

        return view('user.shopping_cart', ['cart' => $cart]);
    }

    public function addToCart(Request $request) {
        $user = auth()->user();
        if($user == null) return response()->json("Musisz się zalogować aby dodać produkty do koszyka.");

        $productAmount = Product::query()->find($request->id);
        if($request->amount > $productAmount->quantity) return response()->json("Nie możesz dodać do koszyka większej ilości niż jest na stanie.");

        $cart_item = new CartItems([
            'product_id' => $request->id,
            'user_id' => $user->id,
            'amount' => $request->amount,
        ]);
        $cart_item->save();
        $productAmount->quantity -= $request->amount;
        $productAmount->save();
        $response = $request->amount." produkt(ów) zostało dodanych do twojego koszyka.";

        return response()->json($response);
    }

    public function updateCart(Request $request) {
        $user = auth()->user();
        if($user == null) return response()->json("Musisz się zalogować aby tego użyć.");

        $product = Product::query()->find($request->id);
        $oldQuantity = CartItems::where('user_id', $user->id)->where('product_id', $request->id)->first();
        if($oldQuantity->amount > $request->amount) {
            $product->quantity += 1;
        } else {
            if($product->quantity - 1 < 0) return response()->json("Nie możesz dodać do koszyka większej ilości niż jest na stanie.");
            $product->quantity -= 1;
        }
        $oldQuantity->amount = $request->amount;
        $product->save();
        $oldQuantity->save();
        $response = $oldQuantity->amount;

        return response()->json($response);
    }

    public function removeFromCart($productId, $amount) {
        $user = auth()->user();
        if($user == null) return response()->json("Musisz się zalogować aby tego użyć.");
        CartItems::where('user_id', $user->id)->where('product_id', $productId)->delete();
        $product = Product::query()->find($productId);
        $product->quantity += $amount;
        $product->save();

        return response()->json("Produkt został usunięty z koszyka.");
    }
}