<?php

namespace App\Http\Controllers;
use App\Models\Producent;

class AppController extends Controller
{
    public function getProducents() {
        $producent = Producent::query()->get();
        return view('shop.partners', ['producents' => $producent]);
    }

//    public function getProductByCategory($category, $subcategory) {
//        $produkt = Product::with('category')
//            ->with('subcategory')
//            ->with('producent')
//            ->where('category_id', $category)
//            ->where('subcategory_id', $subcategory)
//            ->get();
//        return view('shop.show_products', ['produkt' => $produkt]);
//    }
}
