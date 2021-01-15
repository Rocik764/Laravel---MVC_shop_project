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

        $response = $request->amount." produkt(ów) zostało dodanych do twojego koszyka.";
        return response()->json($response);
    }
}
