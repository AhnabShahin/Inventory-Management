<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderCartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
use App\Http\Middleware\AdminCheck;
use App\Models\OrderCart;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');

Route::middleware([AdminCheck::class])->group(function () {
    Route::get('/', [CustomAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
    
    Route::get('customer-form', [CustomerController::class, 'customer_form'])->name('customerForm');
    Route::post('save-customer', [CustomerController::class, 'save_customer'])->name('saveCustomer');
    Route::get('get-customers', [CustomerController::class, 'get_customers'])->name('getCustomers');
    Route::get('get-customer/{id}', [CustomerController::class, 'get_customer'])->name('getCustomer');
    Route::post('update-customer-details/{id}', [CustomerController::class, 'update_customer_details'])->name('updateCustomerDetails');
    Route::get('delete-customer/{id}', [CustomerController::class, 'delete_customer'])->name('deleteCustomer');

    Route::get('product-form', [ProductController::class, 'product_form'])->name('productForm');
    Route::post('save-category', [ProductController::class, 'save_category'])->name('saveCategory');
    Route::get('delete-category/{id}', [ProductController::class, 'delete_category'])->name('deleteCategory');
    Route::post('save-product', [ProductController::class, 'save_product'])->name('saveProduct');
    Route::get('get-products', [ProductController::class, 'get_products'])->name('getProducts');
    Route::get('get-product/{id}', [ProductController::class, 'get_product'])->name('getProduct');
    Route::post('update-product-details/{id}', [ProductController::class, 'update_product_details'])->name('updateProductDetails');
    Route::get('delete-product/{id}', [ProductController::class, 'delete_product'])->name('deleteProduct');
    
    Route::post('save-product-attribute', [ProductController::class, 'save_product_attribute'])->name('saveProductAttribute');
    Route::get('get-product-attribute/{id}', [ProductController::class, 'get_product_attribute'])->name('getProductAttribute');
    Route::post('update-product-attribute/{id}', [ProductController::class, 'update_product_attribute'])->name('updateProductAttribute');
    Route::get('delete-product-attribute/{id}', [ProductController::class, 'delete_product_attribute'])->name('deleteProductAttribute');
    
    Route::post('add-to-cart/{attributes_id}', [OrderCartController::class, 'add_to_cart'])->name('addToCart');
    Route::get('remove-from-cart/{order_cart_item_id}', [OrderCartController::class, 'remove_From_cart'])->name('removeFromCart');
    
    Route::get('check-out', [SellController::class, 'check_out'])->name('checkOut');
    Route::post('sell', [SellController::class, 'sell'])->name('sell');
    Route::get('sells', [SellController::class, 'sells'])->name('sells');
    Route::get('sell-details/{sell_id}', [SellController::class, 'sell_details'])->name('sellDetails');
    Route::get('invoice-download/{sell_id}', [SellController::class, 'invoice_download'])->name('invoiceDownload');

    
});
