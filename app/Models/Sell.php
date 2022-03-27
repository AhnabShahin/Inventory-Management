<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'sell_id',
        'cost_price',
        'sell_price_before_discount',
        'discount', 
        'sell_price_after_discount',
        'profit_margin',
        'delivery_address',
        'payment_type',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class,'sell_id')->orderBy('id', 'DESC');
    }
}
