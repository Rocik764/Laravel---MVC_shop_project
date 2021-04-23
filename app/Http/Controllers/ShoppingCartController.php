<?php

namespace App\Http\Controllers;

use App\Models\CartItems;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isEmpty;

class ShoppingCartController extends Controller
{
    public function showCart() {
        $user = auth()->user();
        $cart = CartItems::query()->with('product')->where('user_id', $user->id)->get();
        if ($cart->isEmpty()) {
            $cart = null;
            return view('user.shopping_cart', ['cart' => $cart]);
        }

        return view('user.shopping_cart', ['cart' => $cart]);
    }

    public function addToCart(Request $request) {
        $user = auth()->user();
        if($user == null) return response()->json("In order to add products to the cart, you must be logged in.");

        $productAmount = Product::query()->find($request->id);
        if($request->amount > $productAmount->quantity) return response()->json("There's not enough products.");
        if($request->amount <= 0) return response()->json("You cannot add zero or less than zero products to the cart.");

        $cart_item = new CartItems([
            'product_id' => $request->id,
            'user_id' => $user->id,
            'amount' => $request->amount,
        ]);
        $cart_item->save();
        $productAmount->quantity -= $request->amount;
        $productAmount->save();
        $response = $request->amount." products have been added to your cart.";

        return response()->json($response);
    }

    public function updateCart(Request $request) {
        $user = auth()->user();
        if($user == null) return response()->json("In order to use this, you must be logged in.");

        $product = Product::query()->find($request->id);
        $oldQuantity = CartItems::where('user_id', $user->id)->where('product_id', $request->id)->first();
        if($oldQuantity->amount > $request->amount) {
            $product->quantity += 1;
        } else {
            if($product->quantity - 1 < 0) return response()->json("There's not enough products.");
            $product->quantity -= 1;
        }
        $oldQuantity->amount = $request->amount;
        $product->save();
        $oldQuantity->save();
        $response = $oldQuantity->getSubtotal();

        return response()->json($response);
    }

    public function removeFromCart($productId, $amount) {
        $user = auth()->user();
        if($user == null) return response()->json("In order to use this, you must be logged in.");
        CartItems::where('user_id', $user->id)->where('product_id', $productId)->delete();
        $product = Product::query()->find($productId);
        $product->quantity += $amount;
        $product->save();

        return response()->json("Product has been removed from your cart.");
    }

    public function getOrderInfo() {
        $user = auth()->user();
        $cart = CartItems::query()->with('product')->where('user_id', $user->id)->get();
        if ($cart->isEmpty()) {
            return redirect()->action('ShoppingCartController@showCart');
        } else {
            $subtotal = 0;
            foreach ($cart as $item) $subtotal += $item->getSubtotal();
        }

        return view('user.order_details', ['subtotal' => $subtotal]);
    }

    public function postOrder(Request $request) {
        $request->validate([
            'address' => 'required',
            'code' => ['required', 'regex:/([0-9][0-9]\-[0-9][0-9][0-9])/'],
            'city' => ['required', 'regex:/^[A-Z-ŻŹĆĄŚĘŁÓŃ][a-zA-Z-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+$/', 'min:3', 'max:255'],
            'phone' => ['required', 'regex:/\+\d{2}\s\d{3}\s\d{3}\s\d{3}/'],
            'delivery' => ['required', Rule::in(['kurier', 'osobiście', 'paczkomat'])],
            'payment' => ['required', Rule::in(['blik', 'przelew', 'przy odbiorze', 'karta płatnicza', 'dotpay'])],
            'regulations' => 'required'
        ]);

        $user = auth()->user();
        $fullAddress = $request->input('address').' '.$request->input('code').' '.$request->input('city');
        $date = date('Y-m-d H:i:s');
        $invoice = false;
        if($request->has('invoice')) $invoice = true;
        $totalPrice = self::getTotalPrice($user);

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
            'total_price' => $totalPrice
        ]);

        try {
            $order->save();
        } catch (\Exception $e) {
            return redirect()->route('show_cart')->with('info', $e->getMessage());
        }

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

    private function getTotalPrice($user) {
        $totalPrice = 0;
        $cart = CartItems::query()->with('product')->where('user_id', $user->id)->get();

        foreach ($cart as $item) {
            $totalPrice += $item->getSubtotal();
        }

        return $totalPrice;
    }
}
