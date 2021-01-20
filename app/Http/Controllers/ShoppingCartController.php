<?php

namespace App\Http\Controllers;

use App\Models\CartItems;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use DateTime;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function showCart() {
        $user = auth()->user();
        $cart = CartItems::query()->with('product')->where('user_id', $user->id)->get();
        if ($cart->isEmpty()) {
            $cart = null;
            return view('user.shopping_cart', ['cart' => $cart]);
        }
        error_log('kekw XDDDDDDDDD');

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

    public function getOrderInfo() {
        $user = auth()->user();
        $cart = CartItems::query()->with('product')->where('user_id', $user->id)->get();
        $subtotal = 0;
        foreach ($cart as $item) $subtotal += $item->getSubtotal();

        return view('user.order_details', ['subtotal' => $subtotal]);
    }

    public function postOrder(Request $request) {
        $user = auth()->user();
        $fullAddress = $request->input('address').' '.$request->input('code').' '.$request->input('city');
        $date = date('Y-m-d H:i:s');
        $invoice = false;
        if($request->has('invoice')) $invoice = true;
        $order = new Order([
            'user_id' => $user->id,
            'purchase_date' => $date,
            'is_completed' => false,
            'address' => $fullAddress,
            'invoice' => $invoice,
            'phone' => $request->input('phone'),
            'comment' => $request->input('comment'),
            'delivery' => $request->input('delivery'),
            'payment' => $request->input('payment'),
            'total_price' => $request->input('totalPrice')
        ]);
        $order->save();
        self::copyCartToDetails($user, $date);

        return redirect()->action('ShoppingCartController@showCart');
    }

    private function copyCartToDetails($user, $date) {
        $cart = CartItems::query()->with('product')->where('user_id', $user->id)->get();
        foreach ($cart as $item) {
            $orderDetails = new OrderDetails([
                'product_id' => $item->product_id,
                'user_id' => $item->user_id,
                'amount' => $item->amount,
                'purchase' => $date
            ]);
            $orderDetails->save();
        }
        $cart = CartItems::query()->with('product')->where('user_id', $user->id)->delete();
    }
}
