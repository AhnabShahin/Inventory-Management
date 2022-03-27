<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderCart;
use App\Models\Sell;
use Exception;
use Illuminate\Http\Request;
use PDF;

class SellController extends Controller
{
    public function __construct()
    {
        try {
            $this->order_cart_items = OrderCart::with('product:id,product_id,title')->orderBy('id', 'DESC')->get();
        } catch (QueryException $e) {
            return;
        }
    }
    function check_out()
    {
        $card_items = OrderCart::with('product')->with('product_attribute')->get();
        $customers = Customer::get();
        $data = [
            'card_items' => $card_items,
            'order_cart_items' => $this->order_cart_items,
            'customers' => $customers,
        ];
        return view('check-out')->with($data);
    }
    function sell(Request $request)
    {
        $request->validate([
            'unit_selling_price.*' => 'required',
            'customer_id' => 'required',
        ]);

        try {
            $data['customer_id'] = $request->customer_id;
            $data['sell_id'] = 'S-' . date('mdHis');
            $data['discount'] = $request->discount;
            $data['payment_type'] = $request->payment_type;
            if ($request->delivery_address) {
                $data['delivery_address'] = $request->delivery_address;
            } else {
                $customer_details = Customer::find($request->customer_id);
                $data['delivery_address'] = $customer_details->address;
            }
            $data['cost_price'] = 0;
            $data['sell_price_before_discount'] = 0;
            $card_items = OrderCart::with('product')->with('product_attribute')->get();
            foreach ($request->unit_selling_price as $key => $item) {
                $data['cost_price'] = $data['cost_price'] + ($card_items[$key]->product_attribute->unit_price * $card_items[$key]->quantity);
                $data['sell_price_before_discount'] = $data['sell_price_before_discount'] + ($request->unit_selling_price[$key] * $card_items[$key]->quantity);
            }
            $data['sell_price_after_discount'] = $data['sell_price_before_discount'] - $request->discount;
            $data['profit_margin'] = $data['sell_price_after_discount'] - $data['cost_price'];
            $sell_details= Sell::create($data);

            foreach ($card_items  as $key => $item) {
                $order['product_id'] = $item->product_id;
                $order['sell_id'] = $sell_details->id;
                $order['product_attribute_id'] = $item->product_attribute_id;
                $order['color'] = $item->color;
                $order['size'] = $item->size;
                $order['quantity'] = $item->quantity;
                $order['unit_buying_price'] = $item->product_attribute->unit_price;
                $order['total_buying_price'] = $item->product_attribute->unit_price * $item->quantity;
                $order['unit_selling_price'] = $request->unit_selling_price[$key];
                $order['total_selling_price'] = $request->unit_selling_price[$key] * $item->quantity;
                $order['unit_profit'] = $order['unit_selling_price'] - $order['unit_buying_price'];
                $order['total_profit'] = $order['total_selling_price'] - $order['total_buying_price'];
                Order::create($order);
                OrderCart::where('id', $item->id)->delete();
            }
            $data = [
                'message' => 'Selling Process is successfully Completed',
            ];
            return redirect()->route('sells')->with($data);
        } catch (Exception $e) {
            $data = [
                'error' =>  $e->getMessage(),
            ];
            return redirect()->route('checkOut')->with($data);
        }
    }
    function sells(){
        $sells = Sell::orderBy('id', 'DESC')->get();
        $data = [
            'order_cart_items' => $this->order_cart_items,
            'sells' =>  $sells,
        ];
        return view('sells')->with($data);
    }
    function sell_details($sell_id){
        $sell_details = Sell::find($sell_id);
        $data = [
            'order_cart_items' => $this->order_cart_items,
            'sell_details' =>  $sell_details,
        ];
        return view('sell-details')->with($data);
    }
    function invoice_download($sell_id){
        $sell_details=Sell::find($sell_id);
        $data = [
            'sell_details' =>  $sell_details,
        ];
        // return view('pdf-template.sell-invoice')->with($data);
        $pdf = PDF::loadView('pdf-template.sell-invoice', compact('sell_details'), [], [
            'title' => 'Preview',
            'orientation' => 'P',
            'format' => 'A4',
        ]);
        return $pdf->stream('document.pdf');
    }
}
