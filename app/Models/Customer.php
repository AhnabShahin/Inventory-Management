<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'first_name',
        'middle_name',
        'last_name',
        'mobile',
        'email',
        'intro',
        'address',
        'image',
    ];
    public function sells()
    {
        return $this->hasMany(Sell::class,'customer_id')->orderBy('id', 'DESC');
    }
}
