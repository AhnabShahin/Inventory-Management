<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\OrderCart;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        try {
            $this->order_cart_items = OrderCart::with('product:id,product_id,title')->orderBy('id', 'DESC')->get();
        } catch (QueryException $e) {
            return;
        }
    }
    public function customer_form()
    {
        $data = [
            'order_cart_items' => $this->order_cart_items,
        ];
        return view('customer-form')->with($data);
    }
    public function save_customer(Request $request)
    {
        try {
            $data = $request->only(
                'first_name',
                'middle_name',
                'last_name',
                'mobile',
                'email',
                'intro',
                'address',
            );
            $data['customer_id'] = 'C-' . date('mdHis');
            if ($request->file('image')) {
                $image_name = date('mdHis') .  "." . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('/uploads/images/customers'), $image_name);
                $data['image'] = $image_name;
            }
            Customer::create($data);
            $data = [
                'message' => 'Customer is registered successfully'
            ];
            return redirect()->route('customerForm')->with($data);
        } catch (QueryException $e) {
            $data = [
                'error' => $e->errorInfo[0] == 23000 ? 'This email or mobile number is already used by a Customer' : $e->getMessage(),
            ];
            return redirect()->route('customerForm')->with($data);
        }
    }
    public function get_customers()
    {
        $customers = Customer::get();
        $data = [
            'customers' => $customers,
            'order_cart_items' => $this->order_cart_items,
        ];
        return view('customers')->with($data);
    }
    public function get_customer($id)
    {
        $customer = Customer::find($id);
        $data = [
            'customer' => $customer,
            'order_cart_items' => $this->order_cart_items,
        ];
        return view('update-customer')->with($data);
    }
    public function update_customer_details(Request $request, $id)
    {
        try {
            $data = $request->only(
                'first_name',
                'middle_name',
                'last_name',
                'mobile',
                'email',
                'intro',
                'address',
            );
            if ($request->file('image')) {
                $image_name = date('mdHis') .  "." . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('/uploads/images/customers'), $image_name);
                $data['image'] = $image_name;
            }
            Customer::where('id', $id)
                ->update($data);
            $data = [
                'message' => 'Customer details is successfully updated'
            ];
            return redirect()->route('getCustomers')->with($data);
        } catch (Exception $e) {
            $data = [
                'error' => $e->errorInfo[0] == 23000 ? 'This email or mobile number is already used by a Customer' : $e->getMessage(),
            ];
            return redirect()->route('getCustomer', [$id])->with($data);
        }
    }
    public function delete_customer($id)
    {
        try {
            Customer::where('id', $id)->delete();
            $data = [
                'message' => 'Customer is successfully deleted',
            ];
            return redirect()->route('getCustomers')->with($data);
        } catch (Exception $e) {
            $data = [
                'error' =>  $e->getMessage(),
            ];
            return redirect()->route('getCustomers')->with($data);
        }
    }
}
