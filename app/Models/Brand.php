<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Product;


class Brand extends Model
{
    protected $fillable = ['product_id','name','detail','image','price'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }   
}
