<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['seller_id','name','description','image'];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
