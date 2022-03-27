<?php

namespace App\Http\Controllers;

use App\Models\OrderCart;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class OrderCartController extends Controller
{
    function add_to_cart(Request $request, $attributes_id)
    {
        try {
            $productAttribute = ProductAttribute::with('product')->find($attributes_id);
            if ($productAttribute && $request->quantity && $productAttribute->quantity >= $request->quantity && $request->quantity > 0 && $productAttribute->quantity > 0) {
                $data['product_id'] = $productAttribute->product_id;
                $data['product_attribute_id'] = $productAttribute->id;
                $data['color'] = $productAttribute->color;
                $data['size'] = $productAttribute->size;
                $data['quantity'] = $request->quantity;
                $data['title'] = $productAttribute->product->title;
                OrderCart::create($data);
                ProductAttribute::where('id', $attributes_id)
                    ->update(['quantity' => $productAttribute->quantity - $request->quantity]);
                $data = [
                    'message' => 'Successfully Add To Cart',
                ];
            }else{
                $data = [
                    'error' => 'Please Enter Valid Quantity',
                ];
            }
            return redirect()->route('getProducts')->with($data);
        } catch (Exception $e) {
            $data = [
                'error' =>  $e->getMessage(),
            ];
            return redirect()->route('getProducts')->with($data);
        }
    }
    function remove_From_cart($order_cart_item_id)
    {
        try {
            $order_cart_item = OrderCart::with('product_attribute')->find($order_cart_item_id);
            ProductAttribute::where('id', $order_cart_item->product_attribute_id)
                ->update(['quantity' => $order_cart_item->product_attribute->quantity + $order_cart_item->quantity]);
            OrderCart::where('id', $order_cart_item_id)->delete();
            $data = [
                'message' => 'Successfully Remove From Cart',
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
