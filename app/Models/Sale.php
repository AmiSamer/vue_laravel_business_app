<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id',
        'selling_date',
        'product_name',
        'product_price',
        'quantity',
        'total_selling_price',
        'receipt_image'
        
    ];
}
