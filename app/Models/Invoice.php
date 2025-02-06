<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',
        'total',
        'discount',
        'vat',
        'payable'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
