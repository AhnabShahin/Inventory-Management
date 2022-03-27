<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'sell_id',
        'product_attribute_id',
        'color',
        'size',
        'quantity', 
        'unit_buying_price',
        'total_buying_price',
        'unit_selling_price',
        'total_selling_price',
        'unit_profit',
        'total_profit',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function product_attribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id', 'id');
    }
    public function sell()
    {
        return $this->belongsTo(Sell::class,'sell_id','id');
    }
}
