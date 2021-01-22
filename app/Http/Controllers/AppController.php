<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Producent;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Mosquitto\Exception;
use function PHPUnit\Framework\isEmpty;

class AppController extends Controller
{
    public function getHome() {
        return redirect()->action('AppController@getIndex');
    }

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
        $products = Product::with('category')
            ->with('subcategory')
            ->with('producent')
            ->where('category_id', $category)
            ->where('subcategory_id', $subcategory)
            ->paginate(8);
        if(isEmpty($products)) return redirect()->route('show_product')->with('info', 'Nie ma takich kategorii.');

        return view('shop.show_product', ['products' => $products]);
    }

    public function getProducts() {
        $products = Product::with('category')->with('subcategory')->with('producent')->paginate(8);

        return view('shop.show_product', ['products' => $products]);
    }

    public function getShowProductInfo($id) {
        try {
            $product = Product::query()->findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('show_product')->with('info', 'Nie ma takiego produktu.');
        } catch (\Exception $exception) {
            return redirect()->route('show_product')->with('info', 'Coś poszło nie tak.');
        }

        return view('shop.product_info', ['product' => $product]);
    }

    public function postSideMenuFiltering(Request $request) {
        $from = 0;
        if(!$request->input('filterPriceFrom') == "") $from = $request->input('filterPriceFrom');

        $to = PHP_FLOAT_MAX;
        if(!$request->input('filterPriceTo') == "") $to = $request->input('filterPriceTo');

        if($from > $to) {
            $temp = $to;
            $to = $from;
            $from = $temp;
        }
        $keyword = $request->input('filterWord');

        $products = Product::with('category')->with('subcategory')->with('producent')
            ->where('name', 'like', "%{$keyword}%")
            ->whereBetween('price', [$from, $to])
            ->paginate(8);

        return view('shop.show_product', ['products' => $products]);
    }

    public function getFiltering() {
        $category = Category::all();
        $subcategory = Subcategory::all();
        $producent = Producent::all();

        return view('shop.filtering', ['categories'=>$category, 'subcategories'=>$subcategory, 'producents'=>$producent]);
    }

    public function postFiltering(Request $request) {
        $from = 0;
        if(!$request->input('filterPriceFrom') == "") $from = $request->input('filterPriceFrom');

        $to = PHP_FLOAT_MAX;
        if(!$request->input('filterPriceTo') == "") $to = $request->input('filterPriceTo');

        if($from > $to) {
            $temp = $to;
            $to = $from;
            $from = $temp;
        }
        $keyword = $request->input('filterWord');

        $cId = array();
        if($request->input('category') == "") $cId = Category::all()->pluck('id')->toArray();
        else $cId[] = $request->input('category');

        $sId = array();
        if($request->input('subcategory') == "") $sId = Subcategory::all()->pluck('id')->toArray();
        else $sId[] = $request->input('subcategory');

        $pId = array();
        if($request->input('producent') == "") $pId = Producent::all()->pluck('id')->toArray();
        else $pId[] = $request->input('producent');

        $products = Product::with('category')->with('subcategory')->with('producent')
            ->where('name', 'like', "%{$keyword}%")
            ->whereBetween('price', [$from, $to])
            ->whereIn('category_id', $cId)
            ->whereIn('subcategory_id', $sId)
            ->whereIn('producent_id', $pId)
            ->paginate(8);

        return view('shop.show_product', ['products' => $products]);
    }
}
