<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'color',
        'size',
        'quantity',
        'unit_price',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function order_carts()
    {
        return $this->hasMany(OrderCart::class,'product_attribute_id')->orderBy('id', 'DESC');
    }
    public function orders()
    {
        return $this->hasMany(Order::class,'product_attribute_id')->orderBy('id', 'DESC');
    }
}
