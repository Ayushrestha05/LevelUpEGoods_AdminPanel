<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutSale extends Model
{
    use HasFactory;
    protected $table = 'checkout_sales';
    protected $fillable = [
        'discount_percent','sale_title','amount_required','is_active'
    ];
}
