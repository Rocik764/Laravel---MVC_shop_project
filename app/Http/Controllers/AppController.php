<?php

namespace App\Http\Controllers;
use App\Models\Producent;
use App\Models\Product;

class AppController extends Controller
{
    public function getProducents() {
        $producent = Producent::query()->get();
        return view('shop.partners', ['producents' => $producent]);
    }

    public function showContact() {
        return view('shop.contact');
    }

    public function getPartners() {
        return view('shop.partners');
    }

    public function getIndex() {
        return view('shop.index');
    }

    public function getProductByCategory($category, $subcategory) {
        $produkt = Product::with('category')
            ->with('subcategory')
            ->with('producent')
            ->where('category_id', $category)
            ->where('subcategory_id', $subcategory)
            ->get();

        return view('admin.products.show_products', ['produkt' => $produkt]);
    }

    public function getProducts() {
        $produkt = Product::with('category')->with('subcategory')->with('producent')->paginate(8);
        return view('shop.show_product', ['produkt' => $produkt]);
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
