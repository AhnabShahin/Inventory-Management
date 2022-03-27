<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'category_id',
        'title',
        'brand',
        'summary',
        'images',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function product_attributes()
    {
        return $this->hasMany(ProductAttribute::class,'product_id')->orderBy('id', 'DESC');
    }
    public function order_carts()
    {
        return $this->hasMany(OrderCart::class,'product_id')->orderBy('id', 'DESC');
    }
    public function orders()
    {
        return $this->hasMany(Order::class,'product_id')->orderBy('id', 'DESC');
    }
}
