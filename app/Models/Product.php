<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function cat(){
        return $this->belongsTo(Category::class, 'cat_id');
    }
    public function orders(){
        return $this->hasMany(Order::class, 'product_id');
    }
}
