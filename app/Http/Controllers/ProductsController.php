<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function getProducts() {
        $produkt = Product::with('category')->with('subcategory')->with('producent')->get();
        //$produkt = Product::query()->get();
        return view('shop.show_products', ['produkt' => $produkt]);
    }

    public function getProductByCategory($category, $subcategory) {
        $produkt = Product::with('category')
            ->with('subcategory')
            ->with('producent')
            ->where('category_id', $category)
            ->where('subcategory_id', $subcategory)
            ->get();
        return view('shop.show_products', ['produkt' => $produkt]);
    }

    public function getUpdateProduct($id) {
        $product = Product::query()->find($id);
        return view('admin.edit_product', ['formType' => 'update', 'product' => $product, 'productId' => $id]);
    }

    public function getDeleteProduct($id) {
        $product = Product::query()->find($id);
        try {
            $product->delete();
        } catch (Exception $e) {
            return back()->withErrors('delete.fail', 'Niepowodzenie usuwania projektu');
        }
        return redirect()->route('shop.show_products');
    }

    public function postCreateProduct(Request $request) {
        $request->validate([
            'name' => 'required|min:2',
            'description' => 'required',
            'quantity' => 'required',
            'price' => 'required'
        ]);
        $product = new Product([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
            'producent_id' => $request->input('producent_id'),
            'subcategory_id' => $request->input('subcategory_id'),
        ]);
        $product->save();

        return redirect()->route('admin.show_products');
    }

    public function postUpdateProduct(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'price' => 'required'
        ]);
        $product = Product::query()->find($request->input('id'));
        $product->fill([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
            'producent_id' => $request->input('producent_id'),
            'subcategory_id' => $request->input('subcategory_id'),
        ]);
        $product->save();

        return redirect()->route('shop.show_products')->with('info', 'Zaktualizowano produkt');
    }
}
