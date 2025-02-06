<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'product_id',
        'user_id',
        'qty',
        'seles_price',
    ];

    public function Product(){
 
        return $this->belongsTo(Product::class);

    }
}
