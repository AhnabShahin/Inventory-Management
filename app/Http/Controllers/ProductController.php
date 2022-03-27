<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OrderCart;
use App\Models\Product;
use App\Models\ProductAttribute;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        try {
            $this->order_cart_items = OrderCart::with('product:id,product_id,title')->orderBy('id', 'DESC')->get();
        } catch (QueryException $e) {
            return;
        }
    }

    public function product_form()
    {
        // dd(Category::with('products')->get());
        $categories = Category::orderBy('id', 'DESC')->get();
        $products = Product::orderBy('id', 'DESC')->get(['id', 'product_id', 'title']);
        $data = [
            'categories' => $categories,
            'products' => $products,
            'order_cart_items' => $this->order_cart_items,
        ];
        return view('product-form')->with($data);
    }
    public function save_category(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $data = $request->only('name');
            Category::create($data);
            $data = [
                'message' => 'New category is successfully added'
            ];
            return redirect()->route('productForm')->with($data);
        } catch (Exception $e) {
            $data = [
                'error' =>  $e->getMessage(),
            ];
            return redirect()->route('productForm')->with($data);
        }
    }
    public function delete_category($id)
    {
        try {
            Category::where('id', $id)->delete();
            $data = [
                'message' => 'New category is successfully deleted'
            ];
            return redirect()->route('productForm')->with($data);
        } catch (Exception $e) {
            $data = [
                'error' =>  $e->getMessage(),
            ];
            return redirect()->route('productForm')->with($data);
        }
    }
    public function save_product(Request $request)
    {
        try {
            $request->validate([
                'category_id' => 'required',
                'title' => 'required',
            ]);
            $data = $request->only(
                'category_id',
                'title',
                'brand',
                'summary',
                'images',
            );
            $data['product_id'] = 'P-' . date('mdHis');
            if ($request->file('images')) {
                $images = [];
                foreach ($request->file('images') as $index => $image) {
                    $image_name = date('mdHis') . "-" . $index . "." . $image->getClientOriginalExtension();
                    $image->move(public_path('/uploads/images/products'), $image_name);
                    array_push($images, $image_name);
                }
                $data['images'] = json_encode($images);
            }
            Product::create($data);
            $data = [
                'message' => 'New Product is successfully added'
            ];
            return redirect()->route('productForm')->with($data);
        } catch (Exception $e) {
            $data = [
                'error' =>  $e->getMessage(),
            ];
            return redirect()->route('productForm')->with($data);
        }
    }
    public function get_products()
    {
        $products = Product::orderBy('id', 'DESC')->with('product_attributes')->with('category')->get();
        $order_cart_items = OrderCart::with('product:id,product_id,title')->orderBy('id', 'DESC')->get();
        $data = [
            'products' => $products,
            'order_cart_items' => $this->order_cart_items,
        ];
        return view('products')->with($data);
    }
    public function get_product($id)
    {
        try {
            $product = Product::find($id);
            $categories = Category::orderBy('id', 'DESC')->get();
            if ($product) {
                $data = [
                    'product' => $product,
                    'categories' => $categories,
                    'order_cart_items' => $this->order_cart_items,
                ];
                return view('update-product')->with($data);
            }
        } catch (Exception $e) {
            $data = [
                'error' =>  $e->getMessage(),
            ];
            return redirect()->route('products')->with($data);
        }
    }
    public function update_product_details(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);
        try {
            $data = $request->only(
                'title',
                'brand',
                'category_id',
                'summary',
                'images',
            );
            if ($request->file('images')) {
                $images = [];
                foreach ($request->file('images') as $index => $image) {
                    $image_name = date('mdHis') . "-" . $index . "." . $image->getClientOriginalExtension();
                    $image->move(public_path('/uploads/images/products'), $image_name);
                    array_push($images, $image_name);
                }
                $data['images'] = json_encode($images);
            }
            Product::where('id', $id)
                ->update($data);
            $data = [
                'message' => 'Product is successfully Updated'
            ];
            return redirect()->route('getProducts')->with($data);
        } catch (Exception $e) {
            $data = [
                'error' =>  $e->getMessage(),
            ];
            return redirect()->route('getProduct', [$id])->with($data);
        }
    }
    public function delete_product($id)
    {
        try {
            Product::where('id', $id)->delete();
            $data = [
                'message' => 'Product is successfully deleted',
            ];
            return redirect()->route('getProducts')->with($data);
        } catch (Exception $e) {
            $data = [
                'error' =>  $e->getMessage(),
            ];
            return redirect()->route('getProducts')->with($data);
        }
    }
    public function save_product_attribute(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required',
                'color' => 'required',
                'size' => 'required',
                'quantity' => 'required',
                'unit_price' => 'required',
            ]);
            $data = $request->only(
                'product_id',
                'color',
                'size',
                'quantity',
                'unit_price',
            );
            ProductAttribute::create($data);
            $data = [
                'message' => 'Product Attribute is successfully added'
            ];
            return redirect()->route('productForm')->with($data);
        } catch (Exception $e) {
            $data = [
                'error' =>  $e->getMessage(),
            ];
            return redirect()->route('productForm')->with($data);
        }
    }
    public function get_product_attribute($id)
    {
        try {
            $productAttribute = ProductAttribute::find($id);
            if ($productAttribute) {
                $data = [
                    'productAttribute' => $productAttribute,
                    'order_cart_items' => $this->order_cart_items,
                ];
                return view('update-product-attribute')->with($data);
            }
        } catch (Exception $e) {
            $data = [
                'error' =>  $e->getMessage(),
            ];
            return redirect()->route('getProducts')->with($data);
        }
    }
    public function update_product_attribute(Request $request, $id)
    {
        try {
            $request->validate([
                'color' => 'required',
                'size' => 'required',
                'quantity' => 'required',
                'unit_price' => 'required',
            ]);
            $data = $request->only(
                'product_id',
                'color',
                'size',
                'quantity',
                'unit_price',
            );
            ProductAttribute::where('id', $id)
                ->update($data);
            $data = [
                'message' => 'Product Attribute is successfully Updated'
            ];
            return redirect()->route('getProducts')->with($data);
        } catch (Exception $e) {
            $data = [
                'error' =>  $e->getMessage(),
            ];
            return redirect()->route('getProductAttribute', [$id])->with($data);
        }
    }
    public function delete_product_attribute($id)
    {
        try {
            ProductAttribute::where('id', $id)->delete();
            $data = [
                'message' => 'Product Attribute is successfully deleted',
            ];
            return redirect()->route('getProducts')->with($data);
        } catch (Exception $e) {
            $data = [
                'error' =>  $e->getMessage(),
            ];
            return redirect()->route('getProducts')->with($data);
        }
    }
}
