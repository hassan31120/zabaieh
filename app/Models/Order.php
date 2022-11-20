<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
}
