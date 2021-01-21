<?php

namespace App\Http\Controllers;
use App\Models\CartItems;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Producent;
use App\Models\Subcategory;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Product;
use Image;
use function PHPUnit\Framework\isEmpty;

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

    public function postNewProducent(Request $request) {
        $producent = new Producent([
           'name' => $request->input('name'),
           'characteristics' => $request->input('characteristics'),
           'phone' => $request->input('phone'),
        ]);
        $producent->save();

        return redirect()->route('new_category_subcategory')->with('info', 'Dodano producenta');
    }

    public function getNewCatSub() {

        return view('admin.products.new_category_subcategory');
    }

    public function getEditCatSub() {

        return view('admin.products.edit_category_subcategory', [
            "categories" => Category::all(),
            "subcategories" => Subcategory::all(),
            "producents" => Producent::all()
        ]);
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

    public function getOrders() {
        $orders = Order::with('user')->get();

        return view('admin.orders.orders_list', ['orders' => $orders]);
    }

    public function completeOrder($id) {
        $order = Order::query()->find($id);
        $value = !$order->is_completed;
        $order->is_completed = $value;
        $order->save();
    }

    public function getDetails($uId, $date) {
        $orderDetails = OrderDetails::where('user_id', $uId)
            ->where('purchase', $date)
            ->get();

        return view('fragments.getdetails', compact('orderDetails'));
    }

    /**
     * Deleting categories / subcategories / producents
     */
    public function postDeleteCategory($id) {
        $category = Category::query()->find($id);
        try {
            $category->delete();
        } catch (QueryException  $e) {
            return back()->withErrors(['Usunięcie tej kategorii spowoduje naruszenie ograniczenia w tabeli produktów ponieważ istnieją produkty z tą kategorią.']);
        } catch (Exception $e) {
            return back()->withErrors(['Niepowodzenie usuwania kategorii.']);
        }

        return redirect()->route('edit_category_subcategory');
    }

    public function postDeleteSubcategory($id) {
        $subcategory = Subcategory::query()->find($id);
        try {
            $subcategory->delete();
        } catch (QueryException  $e) {
            return back()->withErrors(['Usunięcie tej podkategorii spowoduje naruszenie ograniczenia w tabeli produktów ponieważ istnieją produkty z tą podkategorią.']);
        } catch (Exception $e) {
            return back()->withErrors(['Niepowodzenie usuwania podkategorii.']);
        }

        return redirect()->route('edit_category_subcategory');
    }

    public function postDeleteProducent($id) {
        $producent = Producent::query()->find($id);
        try {
            $producent->delete();
        } catch (QueryException  $e) {
            return back()->withErrors(['Usunięcie tego producenta spowoduje naruszenie ograniczenia w tabeli produktów ponieważ istnieją produkty z tym producentem.']);
        } catch (Exception $e) {
            return back()->withErrors(['Niepowodzenie usuwania producenta.']);
        }

        return redirect()->route('edit_category_subcategory');
    }
}
