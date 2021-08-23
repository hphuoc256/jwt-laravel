<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    public $timestamp = false;
    public function product()
    {
        return $this->hasMany(Cart::class,'product_id');
    }
}
