<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    public $timestamp = false;
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }
    public function comment()
    {
        return $this->hasMany(Comment::class,'product_id');
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class,'product_id');
    }
    public function image_product()
    {
        return $this->hasMany(ImageProduct::class,'product_id');
    }
}
