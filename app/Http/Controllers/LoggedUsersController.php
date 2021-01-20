<?php

namespace App\Http\Controllers;

use App\Models\Order;

class LoggedUsersController extends Controller
{
    public function showOrders() {
        $user = auth()->user();
        if($user == null) return redirect()->route('show_index')->with('info', 'Musisz się zalogować aby z tego skorzystać');

        $orders = Order::with('user')->where('user_id', $user->id)->get();

        return view('user.user_orders', ['orders' => $orders]);
    }

    public function showProfile() {
        $user = auth()->user();

        return view('user.user_profile', ['user' => $user]);
    }
}
