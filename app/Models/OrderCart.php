<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCart extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'product_attribute_id',
        'color',
        'size',
        'quantity',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function product_attribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id', 'id');
    }
}
