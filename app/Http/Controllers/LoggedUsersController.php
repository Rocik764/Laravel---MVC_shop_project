<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function getDetails(Request $request) {
        $date = $request->date;
        $uId = Auth::user();
        $orderDetails = OrderDetails::where('user_id', $uId->id)
            ->where('purchase', $date)
            ->get();

        return view('fragments.getdetails', compact('orderDetails'));
    }

    public function getProfile() {

        if(Auth::user()) {
            $user = auth()->user();

            if($user) {
                return view('user.user_profile', ['user' => $user]);
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function editName(Request $request) {
        $request->validate([
            'name' => 'required|min:3|max:30'
        ]);

        $user = auth()->user();

        if($user) {
            $request->user()->fill([
                'name' => $request->name
            ])->save();
//            $user->name = $request['name'];
//            $user->save();
            return redirect()->back();
        }
    }

    public function editEmail(Request $request) {
        $request->validate([
            'mail' => 'required|email:rfc,dns'
        ]);

        $user = auth()->user();

        if($user) {
            $request->user()->fill([
                'email' => $request->email
            ])->save();
//            $user->email = $request['email'];
//            $user->save();
            return redirect()->back();
        }
    }

    public function editPassword(Request $request) {
        $request->validate([
            'password' => 'required|min:8|max:30'
        ]);

        $user = auth()->user();

        if($user) {
            $request->user()->fill([
                'password' => Hash::make($request->password)
            ])->save();
//            $user->email = $request['email'];
//            $user->save();
            return redirect()->back();
        }
    }
}
