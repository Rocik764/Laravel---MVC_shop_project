<?php

namespace App\Http\Controllers;
use App\Models\CartItems;
use App\Models\Category;
use App\Models\Producent;
use App\Models\Subcategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Product;
use Image;

class ProductsController extends Controller
{
    public function getProducts() {
        $products = Product::with('category')->with('subcategory')->with('producent')->get();
        return view('admin.products.show_products', ['products' => $products]);
    }

    public function getNewProduct() {
        $category = Category::all();
        $subcategory = Subcategory::all();
        $producent = Producent::all();
        return view('admin.products.new_product', ['categories'=>$category, 'subcategories'=>$subcategory, 'producents'=>$producent]);
    }

    public function getUpdateProduct($id) {
        $product = Product::query()->find($id);
        $category = Category::all();
        $subcategory = Subcategory::all();
        $producent = Producent::all();
        return view('admin.products.edit_product', ['formType' => 'update', 'product' => $product, 'productId' => $id,
            'categories'=>$category,
            'subcategories'=>$subcategory,
            'producents'=>$producent]);
    }

    public function getDeleteProduct($id) {
        $product = Product::query()->find($id);
        try {
            $product->delete();
        } catch (Exception $e) {
            return back()->withErrors('delete.fail', 'Niepowodzenie usuwania produktu');
        }
        return redirect()->route('list_products');
    }

    public function postCreateProduct(Request $request) {

        $file = pathinfo($request->input('image'), PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'jpeg', 'png');
        if(in_array($file, $allowTypes)) {
            $image = $_FILES['image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));
        } else $imgContent = "test";

        $product = new Product([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
            'producent_id' => $request->input('producent_id'),
            'subcategory_id' => $request->input('subcategory_id'),
            'image' => $imgContent,
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

    public function getNewCatSub() {
        return view('admin.products.new_category_subcategory');
    }

    public function postNewCategory(Request $request) {
        $category = new Category([
            'name' => $request->input('name'),
        ]);

        $category->save();
        return redirect()->route('new_category_subcategory')->with('info', 'Dodano kategorię');
    }

    public function postNewSubcategory(Request $request) {
        $subcategory = new Subcategory([
            'name' => $request->input('name'),
        ]);

        $subcategory->save();
        return redirect()->route('new_category_subcategory')->with('info', 'Dodano podkategorię');
    }
}
